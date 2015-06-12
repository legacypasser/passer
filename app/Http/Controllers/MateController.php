<?php
/**
 * Created by PhpStorm.
 * User: Think
 * Date: 2015/4/5
 * Time: 13:52
 */

namespace App\Http\Controllers;


use App\Http\Middleware\MateMiddleware;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use App\Mate;

class MateController extends Controller {
    public function register(){
        $email = Input::get('email');
        $nickname = Input::get('nickname');
        if(Mate::where('email', '=', $email)->count() != 0)
            return 'email_used';
        $mate = Mate::create(['email'=>$email,
            'password'=>Input::get('password'),
            'nickname'=>$nickname,
            'school'=>Input::get('school'),
            'major'=>Input::get('major'),
            'schoolid'=>input::get('schoolid'),
            'majorid'=>input::get('majorid'),
            'region'=>input::get('region'),
            'inform'=>false,
            'lati'=>Input::get('lati'),
            'longi'=>Input::get('longi')]);
        $activecode = md5($email . strtotime($mate->register));
        $mate->activecode = $activecode;
        $mate->save();
        $id = $mate->id;
        Mail::queue('register',compact(['activecode', 'nickname', 'id']), function($message) use($email) {
            $message->to($email, '同学')->subject('欢迎注册');
        });
        return $mate->id;
    }

    public function login(){
        $email = Input::get('email');
        $password = Input::get('password');
        try{
            $mate = Mate::where('email', '=', $email)->firstOrFail();
        }catch (ModelNotFoundException $e){
            return 'email_fail';
        }
        if($mate->actived == 0)
            return 'not_actived';
        if($mate->password == $password) {
            Session::put(MateMiddleware::$VERIFY, $mate->id);
            return $mate;
        }else
            return 'password_fail';
    }

    public function active(){
        $mate = Mate::find(Input::get('id'));
        if($mate->actived == 1)
            return 'already_active';
        if($mate->activecode != Input::get('code'))
            return 'wrong_code';
        $mate->actived = 1;
        $mate->save();
        return 'activated';
    }

    public function info(){
        $mate = Mate::find(Input::get('id'));
        $result = ['id'=>$mate->id, 'nickname'=>$mate->nickname, 'school'=>$mate->school, 'major'=>$mate->major, 'lati'=>$mate->lati, 'longi'=>$mate->longi];
        return $result;
    }
}

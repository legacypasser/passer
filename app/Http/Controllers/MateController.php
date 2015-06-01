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
        //Mail::send('register',compact('email'), function($message) use($email){
        //    $message->to('864633261@qq.com', 'xiaopan')->subject('hello');
        //});
        $mate = Mate::create(['email'=>$email,
            'password'=>Input::get('password'),
            'nickname'=>Input::get('nickname'),
            'school'=>Input::get('school'),
            'major'=>Input::get('major'),
            'schoolid'=>input::get('schoolid'),
            'majorid'=>input::get('majorid'),
            'region'=>input::get('region'),
            'inform'=>false,
            'lati'=>Input::get('lati'),
            'longi'=>Input::get('longi')]);
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
        if($mate->password == $password) {
            Session::put(MateMiddleware::$VERIFY, $mate->id);
            return $mate;
        }else
            return 'password_fail';
    }

    public function info(){
        $mate = Mate::find(Input::get('id'));
        $result = ['id'=>$mate->id, 'nickname'=>$mate->nickname, 'school'=>$mate->school, 'major'=>$mate->major, 'lati'=>$mate->lati, 'longi'=>$mate->longi];
        return $result;
    }
}

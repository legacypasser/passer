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
use App\Mate;

class MateController extends Controller {
    public function register(){
        $mate = Mate::create(['email'=>Input::get('email'),
            'password'=>Input::get('password'),
            'nickname'=>Input::get('nickname'),
            'school'=>Input::get('school'),
            'major'=>Input::get('major'),
            'inform'=>false]);
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
        $result = ['id'=>$mate->id, 'nickname'=>$mate->id];
        return $result;
    }
}
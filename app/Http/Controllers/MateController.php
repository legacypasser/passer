<?php
/**
 * Created by PhpStorm.
 * User: Think
 * Date: 2015/4/5
 * Time: 13:52
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Mate;

class MateController extends Controller {
    public function register(){
        Mate::create(['phone'=>Input::get('phone'),
            'password'=>Input::get('password'),
            'nickname'=>Input::get('nickname'),
            'school'=>Input::get('school'),
            'major'=>Input::get('school'),
            'inform'=>false]);
        return 'success';
    }

    public function login(){
        $phone = Input::get('phone');
        $password = Input::get('password');
        if(Mate::attempt(['phone'=>$phone, 'password'=>$password])){
            Session::put('mate', Mate::find($phone));
        }
    }

}
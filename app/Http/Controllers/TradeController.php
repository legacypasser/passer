<?php
/**
 * Created by PhpStorm.
 * User: Think
 * Date: 2015/4/5
 * Time: 14:30
 */

namespace App\Http\Controllers;

use App\Http\Middleware\MateMiddleware;
use App\Interest;
use App\Legacy;
use App\Trade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class TradeController extends Controller{

    public function finish(){
        $legacyNum = Input::get('id');
        $sellerId = Session::get(MateMiddleware::$VERIFY);
        $legacy = Legacy::find($legacyNum);
        if($legacy->owner->id != $sellerId)
            return 'invalid';
        DB::beginTransaction();
        Trade::create(['id'=>$legacy->id,
            'buyer'=>Input::get('buyer'),
            'seller'=>$sellerId,
            'description'=>$legacy->des,
            'img'=>$legacy->img]);
        $legacy->delete();
        DB::commit();
        return 'success';
    }

    public function interest(){
        DB::beginTransaction();
        Interest::create(['res'=>Input::get('id'),'wanderer'=>Session::get(MateMiddleware::$VERIFY)]);
        DB::commit();
        return 'recorded';
    }
} 
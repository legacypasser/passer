<?php
/**
 * Created by PhpStorm.
 * User: Think
 * Date: 2015/4/5
 * Time: 14:27
 */

namespace App\Http\Controllers;



use App\Http\Middleware\MateMiddleware;
use App\Legacy;
use App\Mate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PostController extends Controller{

    public function recommend(){
        /*$mate = Mate::find(Session::get(MateMiddleware::$VERIFY));
        $result = [];
        foreach($mate->interests as $interest){
            $result[] = $interest->res;
        }
        $legacies = Legacy::whereIn('id', $result)->paginate(10);
        return $this->buildAbsResult($legacies);*/
        return $this->buildAbsResult(Legacy::all());
    }

    private function buildAbsResult($legacies){
        $result = [];
        foreach($legacies as $legacy)
            $result[] = ['id'=>$legacy->id, 'abs'=>$legacy->abs, 'img'=>$legacy->img,'publish'=>$legacy->publish];
        return json_encode($result);
    }

    public function search(){
        $legacies = DB::select('SELECT id,abs ,img,publish FROM legacy WHERE MATCH (des) AGAINST (? IN BOOLEAN MODE)',[Input::get('keyword')]);
        return $this->buildAbsResult($legacies);
    }

    public function personal(){
        $mate = Mate::find(Input::get('id'));
        $legacies = $mate->legacies()->paginate(10);
        return $this->buildAbsResult($legacies);
    }

    public function detail(){
        $legacy = Legacy::find(Input::get('id'));
        $seller = $legacy->owner;
        $result = ['des'=>$legacy->des, 'seller'=>$seller->id, 'nickname'=>$seller->nickname];
        return json_encode($result);
    }

    public function publish(){
        $finalImg = "";
        $imgs = Input::file();
        if($imgs != [null] && $imgs != null){
            foreach($imgs as $img) {
                $extension = '.' . $img->getClientOriginalExtension();
                $oneName = uniqid() . $extension;
                $finalImg = $finalImg . $oneName . ';';
                $img->move(base_path() . '/../passerImg', $oneName);
            }
        }
        $fully = Input::get('des');
        $abs = substr($fully, 0 , 90).'...';
        $legacy = Legacy::create(['des'=>$fully,
            'seller'=>Session::get(MateMiddleware::$VERIFY),
            'img'=>$finalImg,
            'abs'=>$abs]);
        return $legacy->id;
    }

} 

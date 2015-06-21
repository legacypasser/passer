<?php
/**
 * Created by PhpStorm.
 * User: Think
 * Date: 2015/4/5
 * Time: 14:30
 */

namespace App\Http\Controllers;

use App\Http\Middleware\MateMiddleware;
use App\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Mate;

class MessageController extends Controller{

    public function offlineMessage(){
        $mate = Mate::find(Session::get(MateMiddleware::$VERIFY));
        if($mate->inform == false){
            return '[]';
        }else{
            $record = $mate->coming()->orderBy('edit', 'asc');
            $result = json_encode($record->get(['id', 'sender', 'receiver', 'content', 'edit']));
            DB::beginTransaction();
            $mate->inform = false;
            $mate->save();
            $record->delete();
            DB::commit();
            return $result;
        }
    }

    public function chat(){
        $receiverId = Input::get('receiver');
        DB::beginTransaction();
        $message = Message::create(['sender'=>Session::get(MateMiddleware::$VERIFY),'receiver'=>$receiverId,'content'=>Input::get('content')]);
        $mate = Mate::find($receiverId);
        $mate->inform = true;
        $mate->save();
        DB::commit();
        $result = Message::find($message->id);
        //$result = ['id'=>$message->id, 'sender'=>$message->sender, 'receiver'=>$message->receiver, 'content'=>$message->content, 'edit'=>$message->edit];
        return $result;
    }

} 

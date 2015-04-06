<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	//
    protected $table = 'message';
    protected $fillable = ['sender','receiver','content'];
    public $incrementing = false;
    public $timestamps = false;
    public function theSender(){
        return $this->belongsTo('App\Mate','sender','id');
    }
    public function theReceiver(){
        return $this->belongsTo('App\Mate', 'receiver','id');
    }
}

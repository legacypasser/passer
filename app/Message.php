<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	//
    protected $table = 'message';
    protected $fillable = ['sender','receiver','content'];
    protected $incrementing = false;
    public $timestamps = false;
    public function sender(){
        return $this->belongsTo('App\Mate','phone','sender');
    }
    public function receiver(){
        return $this->belongsTo('App\Mate', 'phone','receiver');
    }
}

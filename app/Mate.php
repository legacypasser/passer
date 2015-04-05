<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Mate extends Model {

	//
    protected $primaryKey = 'phone';
    protected $table = 'mate';
    protected $fillable = ['phone','password','nickname', 'school','major', 'inform'];
    protected $incrementing = false;
    public $timestamps = false;

    public function legacies(){
        return $this->hasMany('App\Legacy', 'seller', 'phone');
    }

    public function sales(){
        return $this->hasMany('App\Trade', 'seller', 'phone');
    }

    public function purchases(){
        return $this->hasMany('App\Trade', 'buyer', 'phone');
    }

    public function sent(){
        return $this->hasMany('App\Message', 'sender', 'phone');
    }
    public function coming(){
        return $this->hasMany('App\Message', 'receiver', 'phone');
    }
    public function wanders(){
        return $this->hasMany('App\Interest', 'wanderer', 'phone');
    }
}

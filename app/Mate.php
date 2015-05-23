<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Mate extends Model {

	//
    protected $table = 'mate';
    protected $fillable = ['email','password','nickname', 'school','major', 'inform', 'longi', 'lati', 'schoolid', 'majorid', 'region'];
    public $timestamps = false;

    public function legacies(){
        return $this->hasMany('App\Legacy', 'seller', 'id');
    }

    public function sales(){
        return $this->hasMany('App\Trade', 'seller', 'id');
    }

    public function purchases(){
        return $this->hasMany('App\Trade', 'buyer', 'id');
    }

    public function sent(){
        return $this->hasMany('App\Message', 'sender', 'id');
    }
    public function coming(){
        return $this->hasMany('App\Message', 'receiver', 'id');
    }
    public function interests(){
        return $this->hasMany('App\Interest', 'wanderer', 'id');
    }
}

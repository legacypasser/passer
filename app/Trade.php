<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model {

	//
    protected $table = 'trade';
    protected $fillable = ['id', 'buyer','seller','description', 'img'];
    public $incrementing = false;
    public $timestamps = false;

    public function theBuyer(){
        return $this->belongsTo('App\Mate', 'buyer', 'id');
    }
    public function theSeller(){
        return $this->belongsTo('App\Mate', 'buyer', 'id');
    }

}

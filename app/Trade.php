<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model {

	//
    protected $table = 'trade';
    protected $fillable = ['id','buyer','seller','description', 'img'];
    public $incrementing = false;
    public $timestamps = false;

    public function buyer(){
        return $this->belongsTo('App\Mate', 'phone', 'buyer');
    }
    public function seller(){
        return $this->belongsTo('App\Mate', 'phone', 'seller');
    }

}

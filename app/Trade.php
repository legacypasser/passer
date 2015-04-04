<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model {

	//
    protected $table = 'trade';
    protected $fillable = ['buyer','seller','description', 'img'];
    protected $incrementing = false;
    public $timestamps = false;

    public function buyer(){
        return $this->belongsTo('App\Mate', 'phone', 'buyer');
    }
    public function seller(){
        return $this->belongsTo('App\Mate', 'phone', 'seller');
    }
}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Legacy extends Model {
		
	//
    protected $table = 'legacy';
    protected $fillable = ['des','seller','img', 'abs', 'price', 'type', 'school'];
    public $timestamps = false;

    public function owner(){
        return $this->belongsTo('App\Mate', 'seller', 'id');
    }

    public function clicks(){
        return $this->hasMany('App\Interest', 'res', 'id');
    }
}

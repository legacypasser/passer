<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Legacy extends Model {
		
	//
    protected $table = 'legacy';
    protected $fillable = ['description','seller','img'];
    protected $incrementing = false;
    public $timestamps = false;

    public function owner(){
        return $this->belongsTo('App\Mate', 'phone', 'seller');
    }

    public function clicks(){
        return $this->hasMany('App\Interest', 'res', 'id');
    }
}

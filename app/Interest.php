<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model {
	
	protected $table = 'interest';
	protected $fillable = ['res','wanderer'];
	protected $incrementing = false;
	public $timestamps = false;
	//
    public function res(){
        return $this->belongsTo('App\Legacy', 'id', 'res');
    }

    public function wanderer(){
        return$this->belongsTo('App\Mate', 'phone', 'wanderer');
    }
}

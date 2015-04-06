<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model {

	protected $table = 'interest';
	protected $fillable = ['res','wanderer'];
	public $incrementing = false;
	public $timestamps = false;
	//
    public function legacy(){
        return $this->belongsTo('App\Legacy', 'res', 'id');
    }

    public function theWanderer(){
        return $this->belongsTo('App\Mate', 'wanderer', 'id');
    }
}

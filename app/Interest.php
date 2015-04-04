<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model {
	
	protected $table = 'interest';
	protected $fillable = ['res','seller','wanderer'];
	protected $incrementing = false;
	public $timestamps = false;
	//

}

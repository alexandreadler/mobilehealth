<?php

class Bloodglucosecontext extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "bloodglucosecontext";
	protected $connection = 'phr';

	public function glucoses() {
		return $this->hasMany('bloodglucose','id_bloodglucosecontext','id');
	}

}
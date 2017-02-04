<?php

class Bloodglucose extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "bloodglucose";
	protected $connection = 'phr';

	public function context() {
		return $this->belongsTo('bloodglucosecontext','id_bloodglucosecontext');
	}

}
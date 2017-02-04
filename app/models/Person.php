<?php

class Person extends \Eloquent {
	protected $fillable = [];

	protected $connection   = 'public';
	protected $table        = "person";
	public $timestamps      = false;


	public function user() {
		return $this->belongsTo('User','person_id');
	}

}
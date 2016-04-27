<?php

class Allergytype extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "allergytype";
	protected $connection = 'phr';


	public function allergies() {
		return $this->hasMany('allergy','id_allergytype','id');
	}


}
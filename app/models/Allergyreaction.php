<?php

class Allergyreaction extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "allergyreaction";
	protected $connection = 'phr';

	public function allergies() {
		return $this->hasMany('allergy','id_allergyreaction','id');
	}

}
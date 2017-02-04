<?php

class Allergy extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "allergy";
	protected $connection = 'phr';


	public function reaction() {
		return $this->belongsTo('allergyreaction','id_allergytype');
	}

	public function type() {
		return $this->belongsTo('allergytype','id_allergytype');
	}



}
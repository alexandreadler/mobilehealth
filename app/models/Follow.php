<?php

class Follow extends \Eloquent {

	protected $fillable = [];

	protected   $connection   = 'app';
	protected   $table        = "follow";

	public function person_from() {
		return $this->belongsTo('Person','id_person_from');
	}

	public function person_to() {
		return $this->belongsTo('Person','id_person_to');
	}

}
<?php

class Message extends \Eloquent {
	protected $fillable = [];

	protected   $connection   = 'app';
	protected   $table        = "message";

	public function person_from() {
		return $this->belongsTo('Person','id_person_from');
	}

	public function person_to() {
		return $this->belongsTo('Person','id_person_to');
	}

}
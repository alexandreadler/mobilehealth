<?php

class Recommendation extends \Eloquent {

	protected $fillable     = [];

	public $timestamps      = false;
	protected $table        = "recommendation";
	protected $connection   = 'public';

	public function content() {
		return $this->belongsTo('Content','id_content');
	}



}
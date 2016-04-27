<?php

class Relatepersoncontent extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "relatepersoncontent";
	protected $connection = 'public';


	public function content() {
		return $this->belongsTo('Content','id_content');
	}


}
<?php

class Relatepersonpost extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "relatepersonpost";
	protected $connection = 'public';


	public function post() {
		return $this->belongsTo('Post','id_post');
	}


}
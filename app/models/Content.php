<?php

class Content extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "content";
	protected $connection = 'public';

	public function person() {
		return $this->hasMany('Relatepersoncontent','id_person','id');
	}

	public function recommendations() {
		return $this->hasMany('Recommendation','id_content','id');
	}

}
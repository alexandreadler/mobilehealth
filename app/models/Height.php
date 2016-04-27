<?php

class Height extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "height";
	protected $connection = 'phr';

}
<?php

class Weight extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "weight";
	protected $connection = 'phr';

}
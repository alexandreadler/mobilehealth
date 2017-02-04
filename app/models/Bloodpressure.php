<?php

class Bloodpressure extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "bloodpressure";
	protected $connection = 'phr';

}
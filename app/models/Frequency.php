<?php

class Frequency extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "frequency";
	protected $connection = 'public';

}
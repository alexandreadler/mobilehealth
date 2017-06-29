<?php

class Hemoglobin extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "hemoglobin";
	protected $connection = 'phr';

}
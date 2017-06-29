<?php

class Imc extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "imc";
	protected $connection = 'phr';

}
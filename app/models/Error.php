<?php

class Error extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "error";
	protected $connection = 'app';

}
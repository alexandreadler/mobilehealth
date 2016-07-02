<?php

class Fonts extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "fonts";
	protected $connection = 'public';

}
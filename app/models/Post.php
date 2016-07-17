<?php

class Post extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "post";
	protected $connection = 'public';

}
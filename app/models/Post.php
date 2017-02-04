<?php

class Post extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;
	protected $table = "posts";
	protected $connection = 'app';

}
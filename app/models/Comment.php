<?php

class Comment extends \Eloquent {

	protected $fillable = [];

	public $timestamps = false;
	protected $table = "comments";
	protected $connection = 'app';

}
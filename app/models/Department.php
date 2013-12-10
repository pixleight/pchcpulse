<?php

class Department extends Eloquent {

	protected $fillable = array('name');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'departments';

	public function users() {
		return $this->hasMany('User');
	}

	public function threads() {
		return $this->hasMany('Threads');
	}
}
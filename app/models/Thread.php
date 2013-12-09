<?php

class Thread extends Eloquent {

	protected $fillable = array('subject', 'token', 'department_id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'threads';

	public function messages() {
		return $this->hasMany('Message');
	}

}
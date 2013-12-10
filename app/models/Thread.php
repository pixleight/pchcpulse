<?php

class Thread extends Eloquent {

	protected $fillable = array('subject', 'token', 'department_id', 'auth_token', 'active', 'anonymous');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'threads';

	public function messages() {
		return $this->hasMany('Message')->orderBy( 'created_at', 'asc' );
	}

	public function users() {
		return $this->belongsToMany('User');
	}

	public function department() {
		return $this->belongsTo('Department');
	}
}
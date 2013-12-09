<?php

class Message extends Eloquent {

	protected $fillable = array('message', 'thread_id', 'user_id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	public function saveMessage( $thread_id, $user_id, $message )
	{
		$this->message = $message;
		$this->thread_id = $thread_id;
		$this->user_id = $user_id;
		return $this->save();
	}
}
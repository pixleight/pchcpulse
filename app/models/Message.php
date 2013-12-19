 <?php

class Message extends Eloquent {

	protected $fillable = array('message', 'thread_id', 'user_id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	public function saveMessage( $thread_id, $user_id = 0, $message, $noreply = false )
	{
		if( $user_id ) {
			$user = User::find( $user_id );
			if( !$user->threads->contains( $thread_id ) ) {
				$user->threads()->attach( $thread_id );
			}
		}

		$this->message = $message;
		$this->thread_id = $thread_id;
		$this->user_id = $user_id;
		$this->noreply = $noreply;
		return $this->save();
	}

	public function user() {
		return $this->belongsTo('User');
	}
}
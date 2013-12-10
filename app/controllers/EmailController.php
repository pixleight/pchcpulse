<?php

class EmailController extends \BaseController {

	function sendConfirmation( $thread, $user, $message ) {
		if( $thread->anonymous ) {
			$user->name = 'Anonymous';
		}

		$data = array(
			'thread' => $thread,
			'user' => $user,
			'msg' => $message
		);

		Mail::send( array( 'text' => 'emails.confirmation' ), $data, function($message) use ( $user )
		{
			$message->from('pulse@pchc.com', 'PCHC Pulse');
		    	$message->to( $user->email, $user->name )->subject('Please confirm your PCHC private message.');
		});
	}

	function sendMessage( $thread, $message ) {
		if( $thread->anonymous ) {
			$user->name = 'Anonymous';
		}

		$data = array(
			'thread' => $thread,
			'msg' => $message,
			'user' => null
		);

		foreach( $thread->users as $user ) {
			$data['user'] = $user;

			Mail::send( array( 'text' => 'emails.message' ), $data, function($message) use ( $user )
			{
				$message->from('pulse@pchc.com', 'PCHC Pulse');
			    	$message->to( $user->email, $user->name )->subject('A new message has been sent.');
			});
		}

	}

}
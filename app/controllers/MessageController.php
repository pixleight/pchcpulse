<?php

class MessageController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$user = User::where( 'token', '=', $data['user_token'] )->first();
		$thread = Thread::where( 'token', '=', $data['thread_token'] )->first();

		$message = new Message;
		if( $message->saveMessage( $thread->id, $user->id, $data['message'] ) ) {
			$emailController = new EmailController;
			$emailController->sendMessage( $thread, $message );
			Session::flash( 'flash_type', 'success' );
			Session::flash( 'flash_message', 'Message successfully saved.');
			return Redirect::action('ThreadController@show', array(
					'thread_token' => $thread->token,
					'user_token' => $user->token
				));
		}

		echo 'saved message';
	}

}
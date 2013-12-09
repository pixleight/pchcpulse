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
		$message->saveMessage( $thread->id, $user->id, $data['message'] );

		echo 'saved message';
	}

}
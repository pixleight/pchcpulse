<?php

class ThreadController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('threads.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$user = User::where( 'email', '=', $data['email'] )->first();
		if( empty($user) ) {
			$user = new User;
			$data['token'] = substr(md5(microtime()),rand(0,26),6);
			$user->fill( $data );
			$user->save();
		}

		$thread_token = substr(md5(microtime()),rand(0,26),6);
		$thread = new Thread;
		$thread->subject = $data['subject'];
		$thread->token = $thread_token;
		$thread->department_id = 1;
		$thread->save();

		$message = new Message;
		$message->saveMessage( $thread->id, $user->id, $data['message'] );

		echo 'done';
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($thread_token, $user_token)
	{
		$thread = Thread::where( 'token', '=', $thread_token )->first();
		if( empty( $thread ) ) {
			Session::flash( 'flash_type', 'danger' );
			Session::flash( 'flash_message', 'Message thread does not exist' );
			return View::make( 'errors.show' );
		}
		$user = User::where( 'token', '=', $user_token )->first();
		if( empty( $user ) ) {
			Session::flash( 'flash_type', 'danger' );
			Session::flash( 'flash_message', 'User does not exist' );
			return View::make( 'flash.show' );
		}
		View::share( 'thread', $thread );
		View::share( 'user', $user );
		return View::make( 'threads.show' );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
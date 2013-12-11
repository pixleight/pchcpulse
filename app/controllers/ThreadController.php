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

		$validator = Validator::make(
			$data,
			array(
				'subject' => 'required',
				'message' => 'required'
			)
		);

		if( $validator->fails() ) {
			$messages = $validator->messages();
			return Redirect::to( 'thread/create' )->withErrors( $validator );
		}

		if( !empty( $data['email'] ) ) {
			$user = User::where( 'email', '=', $data['email'] )->first();
			if( empty($user) ) {
				$user = new User;
				$data['token'] = substr(md5(microtime()),rand(0,26),6);
				$user->fill( $data );
				$user->save();
			} else if( $user->name != $data['name'] ) {
				$user->name = $data['name'];
				$user->save();
			}
		}

		$thread_token = substr(md5(microtime()),rand(0,26),6);
		$thread = new Thread;
		$thread->subject = $data['subject'];
		$thread->token = $thread_token;
		$thread->auth_token = substr( md5($data['subject'].$thread_token), 16);
		$thread->department_id = 1;
		$thread->anonymous = ( !empty($data['anonymous']) ) ? $data['anonymous'] : 0;

		$department = Department::find( $thread->department_id );
		$thread->department()->associate( $department );

		$thread->save();

		foreach( $department->users as $department_user ) {
			$department_user->threads()->attach( $thread->id );
		}

		$message = new Message;
		if( $message->saveMessage( $thread->id, $user->id, $data['message'] ) ) {

			$emailController = new EmailController;
			$emailController->sendConfirmation( $thread, $user, $message );

			Session::flash( 'flash_type', 'success' );
			Session::flash( 'flash_message', 'Your message has been successfully saved.' );
			return View::make( 'threads.confirm' );
		}
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
		$user = User::where( 'token', '=', $user_token )->first();

		$authorizedUser = $this->authorizedView( $thread, $user );
		if( $authorizedUser ) {
			return $authorizedUser;
		}

		if( !$thread->active ) {
			Session::flash( 'flash_type', 'warning' );
			Session::flash( 'flash_message', 'This message thread has not been confirmed yet. Please check your email for the confirmation link.' );
			return View::make( 'threads.confirm' );
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

	public function confirm( $thread_token, $user_token, $auth_token ) {
		$thread = Thread::where( 'token', '=', $thread_token )->first();
		$user = User::where( 'token', '=', $user_token )->first();

		$authorizedUser = $this->authorizedView( $thread, $user );
		if( $authorizedUser ) {
			return $authorizedUser;
		}

		if( $thread->auth_token == $auth_token ) {
			$thread->active = 1;
			$thread->save();
			$message = $thread->messages->first();
			$emailController = new EmailController;
			$emailController->sendMessage( $thread, $message );
			Session::flash( 'flash_type', 'success' );
			Session::flash( 'flash_message', 'Message thread successfully confirmed' );
			return Redirect::action('ThreadController@show', array(
					'thread_token' => $thread->token,
					'user_token' => $user->token
				));
		} else {
			Session::flash( 'flash_type', 'danger' );
			Session::flash( 'flash_message', 'Your confirmation key is incorrect.' );
			return View::make( 'threads.create' );
		}
	}



	/**
	 * Check to see if user is authorized to view the thread
	 *
	 * @param  obj  $thread
	 * @param  obj  $user
	 * @return Response
	 */
	private function authorizedView( $thread, $user ) {
		if( empty( $thread ) ) {
			Session::flash( 'flash_type', 'danger' );
			Session::flash( 'flash_message', 'Message thread does not exist' );
			return View::make( 'threads.create' );
		}

		if( empty( $user ) ) {
			Session::flash( 'flash_type', 'danger' );
			Session::flash( 'flash_message', 'Sorry, you are not authorized to view this message thread.' );
			return View::make('threads.create');
		}

		$allowed_users = $thread->users;

		if( !$allowed_users->contains( $user->id ) ) {
			Session::flash( 'flash_type', 'danger' );
			Session::flash( 'flash_message', 'Sorry, you are not authorized to view this message thread.' );
			return View::make( 'threads.create' );
		}

		return false;
	}

}
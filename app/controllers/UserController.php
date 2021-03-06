<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$sort['orderby'] = Input::get('orderby') ? Input::get('orderby') : 'name';
		$sort['order'] = Input::get('order') ? Input::get('order') : 'asc';
		$users = User::whereRaw("role in ('recipient', 'admin')")->orderBy($sort['orderby'], $sort['order'])->get();
		return View::make('users.index')->with('users', $users)->with('sort', $sort);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$departments = Department::orderBy('name')->get();
		return View::make('users.create')->with('departments', $departments);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		$rules = array(
			'email' => 'required|unique:users'
		);

		if( $data['password'] ) {
			$rules['password'] = 'required';
			$rules['password_confirmation'] = 'required|same:password';
		}

		$validator = Validator::make( $data, $rules );

		if( $validator->fails() ) {
			$messages = $validator->messages();
			return Redirect::to( 'user/create' )->withErrors( $validator )->withInput();
		}

		$user = new User;
		$data['token'] = substr(md5(microtime()),rand(0,26),6);
		$data['password'] = Hash::make( $data['password'] );
		$data['role'] = 'recipient';
		$user->fill( $data );

		$department = Department::find( $data['department_id'] );
		if( empty( $department ) ) {
			$department = new Department;
		}
		$user->department_id = $data['department_id'];
		$user->department()->associate( $department );
		
		$user->save();
		return Redirect::action('UserController@show', array( $user->id ));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$user = User::find($id);
		return View::make('users.show')->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		$departments = Department::all();
		return View::make('users.edit')->with('user', $user)->with('departments', $departments);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();

		$rules = array(
			'department_id' => 'required',
		);

		if( $data['password'] ) {
			$rules['password'] = 'required';
			$rules['password_confirmation'] = 'required|same:password';
		}

		$validator = Validator::make( $data, $rules );

		if( $validator->fails() ) {
			$messages = $validator->messages();
			return Redirect::to( 'user/'.$id.'/edit' )->withErrors( $validator )->withInput();
		}

		$user = User::find( $id );
		$data['password'] = Hash::make( $data['password'] );
		$user->fill( $data );

		$department = Department::find( $data['department_id'] );
		if( empty( $department ) ) {
			$department = new Department;
		}
		$user->department_id = $data['department_id'];
		$user->department()->associate( $department );

		$user->save();
		Session::flash( 'flash_type', 'success' );
		Session::flash( 'flash_message', 'Recipient "' . $user->name . '" has been updated.' );
		return Redirect::action('UserController@index' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		Session::flash( 'flash_type', 'success' );
		Session::flash( 'flash_message', 'Recipient has been deleted.' );
		return Redirect::action('UserController@index');
	}

	public function login()
	{
		return View::make( 'users.login' );
	}

	public function doLogin()
	{
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
			Session::flash( 'flash_type', 'success' );
			Session::flash( 'flash_message', 'You have successfully logged in.' );
			return Redirect::to('thread/create');
		} else {
			Session::flash( 'flash_type', 'danger' );
			Session::flash( 'flash_message', 'Your email/password was incorrect. Please try again.' );
   			return Redirect::to('login')
   				->withInput();
}
	}

}
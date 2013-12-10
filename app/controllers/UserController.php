<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		$departments = Department::all();
		return View::make('users.index')->with('users', $users)->with('departments', $departments);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		Input::flash();
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$user = new User;
		$data['token'] = substr(md5(microtime()),rand(0,26),6);
		$user->fill( $data );
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
		$user = User::find( $id );
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
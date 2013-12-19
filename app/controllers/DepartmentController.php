<?php

class DepartmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$departments = Department::all();
		return View::make('departments.index')->with('departments', $departments);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('departments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$department = new Department;
		$department->fill( $data );
		$department->save();
		Session::flash( 'flash_type', 'success' );
		Session::flash( 'flash_message', 'Department "' . $department->name . '" has been saved.' );
		return Redirect::action('DepartmentController@show', array( $department->id ));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$department = Department::find($id);
		return View::make('departments.show')->with('department', $department);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$department = Department::find($id);
		return View::make('departments.edit')->with('department', $department);
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
			'name' => 'required',
		);
		
		$validator = Validator::make( $data, $rules );

		if( $validator->fails() ) {
			$messages = $validator->messages();
			return Redirect::to( 'department/'.$id.'/edit' )->withErrors( $validator )->withInput();
		}

		$department = Department::find($id);
		$department->name = $data['name'];
		$department->save();

		Session::flash( 'flash_type', 'success' );
		Session::flash( 'flash_message', 'Department "' . $department->name . '" has been updated.' );
		return Redirect::action('DepartmentController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$department = Department::find($id);
		$department->delete();
		Session::flash( 'flash_type', 'success' );
		Session::flash( 'flash_message', 'Department has been deleted.' );
		return Redirect::action('DepartmentController@index');
	}

}
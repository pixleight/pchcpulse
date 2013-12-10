@extends('layout')

@section('content')
	<h2>Create a New Department</h2>

	{{ Form::open(array('action' => 'DepartmentController@store')) }}
		<p>
			{{ Form::label( 'name', 'Name' ) }}
			{{ Form::text( 'name' ) }}
		</p>
		<p>
			{{ Form::submit('Submit') }}
		</p>
	{{ Form::close() }}
@stop
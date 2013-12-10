@extends('layout')

@section('content')
	Department create!

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
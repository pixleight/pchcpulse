@extends('layout')

@section('content')
	<h2>Create a New User!</h2>

	{{ Form::open(array('action' => 'UserController@store')) }}
		<p>
			{{ Form::label( 'email', 'Email Address' ) }}
			{{ Form::text( 'email' ) }}
		</p>
		<p>
			{{ Form::label( 'name', 'Name' ) }}
			{{ Form::text( 'name' ) }}
		</p>
		<p>
			{{ Form::submit('Submit') }}
		</p>
	{{ Form::close() }}
@stop
@extends('layout')

@section('content')
	Threads create!

	{{ Form::open(array('action' => 'ThreadController@store')) }}
		<p>
			{{ Form::label( 'subject', 'Subject' ) }}
			{{ Form::text( 'subject' ) }}
		</p>
		<p>
			{{ Form::label( 'name', 'Name' ) }}
			{{ Form::text( 'name' ) }}
		</p>
		<p>
			{{ Form::label( 'email', 'Name' ) }}
			{{ Form::text( 'email' ) }}
		</p>
		<p>
			{{ Form::label( 'message', 'Message' ) }}
			{{ Form::textarea( 'message' ) }}
		</p>
		<p>
			{{ Form::submit('Submit') }}
		</p>
	{{ Form::close() }}
@stop
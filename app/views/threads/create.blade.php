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
			{{ Form::label( 'email', 'Email' ) }}
			{{ Form::text( 'email' ) }}
		</p>
		<p>
			{{ Form::label( 'anonymous', 'Make these messages anonymous' ) }}
			{{ Form::checkbox( 'anonymous', 1 ) }}
		</p>
		@include('messages.form')
	{{ Form::close() }}
@stop
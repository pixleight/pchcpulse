@extends('layout')

@section('content')
	<h1>{{ $thread->subject }}</h1>

	@foreach ( $thread->messages as $message )
		<?php $user = User::find( $message->user_id ); ?>
		<p>{{{ $user->name }}} : {{{ $message->message }}}</p>
	@endforeach

	{{ Form::open(array('action' => 'MessageController@store')) }}
		{{ Form::hidden( 'user_token', $user->token ) }}
		{{ Form::hidden( 'thread_token', $thread->token ) }}
		@include('messages.form')
	{{ Form::close() }}
@stop
@extends('layout')

@section('content')
	<h1>{{ $thread->subject }}</h1>

	@foreach ( $thread->messages as $message )
		<div class="panel panel-{{($message->user->role == 'sender') ? 'default' : 'primary'}}">
			<div class="panel-heading clearfix">
				<h3 class="panel-title pull-left">
					{{{ $message->user->name }}}
				</h3>
				<small class="pull-right">{{ strftime('%b %e, %Y at %l:%M %p', strtotime($message->created_at) ) }}</small>
			</div>
			<div class="panel-body">
				{{{ $message->message }}}
			</div>
		</div>
	@endforeach

	{{ Form::open(array('action' => 'MessageController@store')) }}
		{{ Form::hidden( 'user_token', $user->token ) }}
		{{ Form::hidden( 'thread_token', $thread->token ) }}
		@include('messages.form')
	{{ Form::close() }}
@stop
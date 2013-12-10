@extends('layout')

@section('content')
	User show!
	<p>{{ $user->name }}</p>
	{{ link_to_route('user.edit', 'Edit', $user->id ); }}
@stop
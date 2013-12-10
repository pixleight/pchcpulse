@extends('layout')

@section('content')
	<h2>{{ $user->name }} <small>User</small></h2>
	{{ link_to_route('user.edit', 'Edit', $user->id ); }}
@stop
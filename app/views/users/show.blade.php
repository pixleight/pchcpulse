@extends('layout')

@section('content')
	<h2>{{ $user->name }} <small>User {{ link_to_route('user.edit', 'Edit', $user->id, array('class' => 'btn btn-default btn-xs') ); }}</small></h2>
	<p><strong>Email:</strong> {{ $user->email }}</p>
	<p><strong>Department:</strong> {{ $user->department->name }}
@stop
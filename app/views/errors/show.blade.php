@extends('layout')

@section('content')
	<div class="alert alert-{{ Session::get('flash_type') }}">
		{{ Session::get('flash_message') }}
	</div>
@stop
@extends('layout')

@section('content')
	<h2>Departments</h2>
	@foreach($departments as $department)
		<p>{{ link_to_route('department.edit', 'Edit', $department->id, array('class' => 'btn btn-primary btn-xs') ); }}  {{ $department->name }}</p>
	@endforeach
@stop
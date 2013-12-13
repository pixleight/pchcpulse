@extends('layout')

@section('content')
	<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Department</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
		@foreach( $users as $user )
			<tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->department ? $user->department->name : '' }}</td>
				<td>{{ link_to_route('user.edit', 'Edit', $user->id, array( 'class' => 'btn btn-primary btn-block') ); }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	</div>
@stop
@extends('layout')

@section('content')
	<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><a href="?orderby=name&order={{ $sort['orderby'] == 'name' && $sort['order'] == 'asc' ? 'desc' : 'asc' }}">
					Name
					<?php if( $sort['orderby'] == 'name' ) : ?>
						<span class="glyphicon glyphicon-sort-by-attributes{{ $sort['orderby'] == 'name' && $sort['order'] == 'asc' ? '' : '-alt' }}"></span>
					<?php endif; ?>
				</a></th>
				<th><a href="?orderby=email&order={{ $sort['orderby'] == 'email' && $sort['order'] == 'asc' ? 'desc' : 'asc' }}">
					Email
					<?php if( $sort['orderby'] == 'email' ) : ?>
						<span class="glyphicon glyphicon-sort-by-attributes{{ $sort['orderby'] == 'email' && $sort['order'] == 'asc' ? '' : '-alt' }}"></span>
					<?php endif; ?>
				</a></th>
				<th><a href="?orderby=department_id&order={{ $sort['orderby'] == 'department_id' && $sort['order'] == 'asc' ? 'desc' : 'asc' }}">
					Department
					<?php if( $sort['orderby'] == 'department_id' ) : ?>
						<span class="glyphicon glyphicon-sort-by-attributes{{ $sort['orderby'] == 'department_id' && $sort['order'] == 'asc' ? '' : '-alt' }}"></span>
					<?php endif; ?>
				</a></th>
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
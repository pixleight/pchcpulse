@extends('layout')

@section('content')
	<h2>Edit user: {{ $user->name }}</h2>

	{{ Form::open(array('action' => array( 'UserController@update', $user->id ), 'method' => 'put' ) ) }}
		<p>
			{{ Form::label( 'name', 'Name' ) }}
			{{ Form::text( 'name', $user->name ) }}
		</p>
		<ul>
			<li>
				<label>
					{{ Form::radio( 'department_id', '', !$user->department ) }}
					None
				</label>
			</li>
			@foreach( $departments as $department )
				<li>
					<label>
						{{ Form::radio( 'department_id', $department->id, $department->id == $user->department_id ) }} {{ $department->name }}
					</label>
				</li>
			@endforeach
		</ul>
		<p>
			{{ Form::submit('Submit') }}
		</p>
	{{ Form::close() }}
@stop
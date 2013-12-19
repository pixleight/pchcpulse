@extends('layout')

@section('content')
	<h2>Edit user: {{ $user->name }}</h2>

	{{ Form::open(array('action' => array( 'UserController@update', $user->id ), 'method' => 'put', 'class' => 'form-horizontal' ) ) }}
		<div class="form-group">
			{{ Form::label( 'email', 'Email Address', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				<p class="form-control-static">{{ $user->email }}</p>
			</div>
		</div>
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			{{ Form::label( 'name', 'Name', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::text( 'name', $user->name, array( 'class' => 'form-control') ) }}
				@include('errors.show', array( 'field' => 'name' ))
			</div>
		</div>
		<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
			{{ Form::label( 'password', 'New Password', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::password( 'password', array( 'class' => 'form-control') ) }}
				@include('errors.show', array( 'field' => 'password' ))
			</div>
		</div>
		<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
			{{ Form::label( 'password_confirmation', 'Confirm Password', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::password( 'password_confirmation', array( 'class' => 'form-control') ) }}
				@include('errors.show', array( 'field' => 'password_confirmation' ))
			</div>
		</div>
		<div class="form-group">
			{{ Form::label( 'departments', 'Department', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				<?php 
				$department_select[''] = 'Select Department';
				foreach( $departments as $department ) {
					$department_select[$department->id] = $department->name;
				} 
				?>
				{{ Form::select('department_id', $department_select, $user->department_id, array( 'class' => 'form-control', 'required' => true ) ) }}
				@include('errors.show', array( 'field' => 'department_id' ))
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{{ Form::submit('Save', array( 'class' => 'btn btn-primary' ) ) }}  
				<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
			</div>
		</div>
	{{ Form::close() }}

	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Confirm Delete</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this?</p>
				</div>
				<div class="modal-footer">
					{{ Form::open(array('action' => array( 'UserController@destroy', $user->id ), 'method' => 'delete' ) ) }}
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						{{ Form::submit('Confirm Delete', array( 'class' => 'btn btn-danger' )) }}
					{{ Form::close() }}
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

@stop
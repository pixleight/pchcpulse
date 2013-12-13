@extends('layout')

@section('content')
	<h2>Create a New User!</h2>

	{{ Form::open(array('action' => 'UserController@store', 'class' => 'form-horizontal')) }}
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			{{ Form::label( 'email', 'Email Address', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::email( 'email', Input::old('email'), array( 'class' => 'form-control', 'required' => true) ) }}
				@include('errors.show', array( 'field' => 'email' ))
			</div>
		</div>
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			{{ Form::label( 'name', 'Name', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::text( 'name', Input::old('name'), array( 'class' => 'form-control', 'required' => true) ) }}
				@include('errors.show', array( 'field' => 'name' ))
			</div>
		</div>
		<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
			{{ Form::label( 'password', 'Password', array( 'class' => 'col-sm-2 control-label' ) ) }}
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
				{{ Form::select('department_id', $department_select, Input::old('department_id'), array( 'class' => 'form-control', 'required' => true ) ) }}
				@include('errors.show', array( 'field' => 'department_id' ))
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{{ Form::submit('Submit', array( 'class' => 'btn btn-primary' ) ) }}
			</div>
		</div>
	{{ Form::close() }}
@stop
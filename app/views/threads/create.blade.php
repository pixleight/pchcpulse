@extends('layout')

@section('content')
	<h2>Create a New Message Thread</h2>
	<p class="lead">
		A message "thread" is a series of messages &amp; replies in single topic. PCHC Pulse allows you to send messages, anonymously if you wish, to many departments in PCHC. Even if you choose to remain anonymous, you will still receive any replies to your messages, and will be able to reply yourself.
	</p>

	{{ Form::open(array('action' => 'ThreadController@store', 'class' => 'form-horizontal' )) }}
		<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
			{{ Form::label( 'subject', 'Subject', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::text( 'subject', Input::old( 'subject'), array( 'class' => 'form-control', 'required' => true ) ) }}
				@include('errors.show', array( 'field' => 'subject' ))
				<span class="help-block">Please briefly describe what this message is about.</span>
			</div>
		</div>
		<div class="form-group {{ $errors->has('department_id') ? 'has-error' : '' }}">
			{{ Form::label( 'department_id', 'Department', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				<?php 
				$department_select[''] = 'Select Department';
				foreach( $departments as $department ) {
					$department_select[$department->id] = $department->name;
				} 
				?>
				{{ Form::select('department_id', $department_select, Input::old('department_id'), array( 'class' => 'form-control', 'required' => true ) ) }}
				@include('errors.show', array( 'field' => 'department_id' ))
				<span class="help-block">Select a department to send this message to.</span>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label( 'name', 'Your Name', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::text( 'name', Input::old( 'name'), array( 'class' => 'form-control' ) ) }}
				<span class="help-block">If you choose to send this message anonymously, your name will never be revealed to the recipient.</span>
			</div>
		</div>
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			{{ Form::label( 'email', 'Your Email', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::email( 'email', Input::old( 'email'), array( 'class' => 'form-control' ) ) }}
				@include('errors.show', array( 'field' => 'email' ))
				<span class="help-block">If you send this message anonymously, the recipient(s) will never see your email address, but you will still be able to send and receive responses.<br>
					You can leave this blank, however, you will never be able to see replies to this message if you do.
					</span>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label( 'anonymous', 'Make these messages anonymous', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::checkbox( 'anonymous', 1 ) }}
				<span class="help-block">You can choose to send this message anonymously. You will still be able to receive replies and reply to this message if you enter your email above.</span>
			</div>
		</div>
		@include('messages.form')
	{{ Form::close() }}
@stop
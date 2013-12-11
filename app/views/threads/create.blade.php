@extends('layout')

@section('content')
	<h2>Create a New Message Thread</h2>

	{{ Form::open(array('action' => 'ThreadController@store', 'class' => 'form-horizontal' )) }}
		<div class="form-group">
			{{ Form::label( 'subject', 'Subject', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::text( 'subject', null, array( 'class' => 'form-control' ) ) }}
				@include('errors.show', array( 'field' => 'subject' ))
				<span class="help-block">Please briefly describe what this message is about.</span>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label( 'name', 'Your Name', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::text( 'name', null, array( 'class' => 'form-control' ) ) }}
				<span class="help-block">If you choose to send this message anonymously, your name will never be revealed to the recipient.</span>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label( 'email', 'Your Email', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
				{{ Form::text( 'email', null, array( 'class' => 'form-control' ) ) }}
				@include('errors.show', array( 'field' => 'email' ))
				<span class="help-block">You can leave this blank, however, you will never be able to see replies to this message if you do.<br>
					If you send this message anonymously, the recipient(s) will never see your email.</span>
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
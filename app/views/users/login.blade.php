@extends('layout')

@section('content')
	<div class="col-sm-6 col-sm-offset-3 jumbotron">
	{{ Form::open(array('url' => 'login', 'class' => 'form-signin' )) }}
		<h1>Please sign in</h1>
		<div class="form-group">
			{{ Form::email( 'email', Input::old( 'email' ), array( 'class' => 'form-control', 'placeholder' => 'Email', 'required' => true, 'autofocus' => true ) ) }}
		</div>
		<div class="form-group">
			{{ Form::password( 'password', array( 'class' => 'form-control', 'placeholder' => 'Password', 'required' => true ) ) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Sign in', array( 'class' => 'btn btn-lg btn-primary btn-block' ) ) }}
		</div>
	{{ Form::close() }}
	</div>
@stop
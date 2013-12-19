@extends('layout')

@section('content')
	<h2>Create a New Department</h2>

	{{ Form::open(array('action' => 'DepartmentController@store', 'class' => 'form-horizontal')) }}
		<div class="form-group">
			{{ Form::label( 'name', 'Name', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
			{{ Form::text( 'name', Input::old( 'name' ), array( 'class' => 'form-control' ) ) }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Submit', array( 'class' => 'btn btn-primary' )) }}
			</div>
		</div>
	{{ Form::close() }}
@stop
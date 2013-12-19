@extends('layout')

@section('content')
	<h2>Edit Department: {{ $department->name }}</h2>

	{{ Form::open(array('action' => array( 'DepartmentController@update', $department->id ), 'method' => 'put', 'class' => 'form-horizontal' ) ) }}
		<div class="form-group">
			{{ Form::label( 'name', 'Name', array( 'class' => 'col-sm-2 control-label' ) ) }}
			<div class="col-sm-10">
			{{ Form::text( 'name', $department->name, array( 'class' => 'form-control' ) ) }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Save', array( 'class' => 'btn btn-primary' )) }}  
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
					{{ Form::open(array('action' => array( 'DepartmentController@destroy', $department->id ), 'method' => 'delete' ) ) }}
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						{{ Form::submit('Delete', array( 'class' => 'btn btn-danger' )) }}
					{{ Form::close() }}
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


@stop
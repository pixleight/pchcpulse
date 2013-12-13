<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
	{{ Form::label( 'message', 'Your Message', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::textarea( 'message', Input::old( 'message'), array( 'class' => 'col-sm-10 form-control', 'required' => true ) ) }}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Submit', array( 'class' => 'btn btn-primary' ) ) }}
	</div>
</div>
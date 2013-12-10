<div class="form-group">
	{{ Form::label( 'message', 'Your Message', array( 'class' => 'col-sm-2 control-label' ) ) }}
	<div class="col-sm-10">
		{{ Form::textarea( 'message', null, array( 'class' => 'col-sm-10 form-control' ) ) }}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Submit', array( 'class' => 'btn btn-primary' ) ) }}
	</div>
</div>
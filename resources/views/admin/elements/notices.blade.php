<?php
	$messages = [
		'messages.crud.create.success' => 'Entry was successfully created',
		'messages.crud.delete.success' => 'Entry was successfully deleted',
		'messages.crud.update.success' => 'Entry was successfully updated'
	];
?>
<!-- START :: Notices -->
@if($errors->has('error') || Session::has('error') || Session::has('info') || Session::has('success') || Session::has('warning'))
<div class="portlet-body">
	<div class="col-sm-10">
	@if(Session::has('error') && !empty($messages))
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<strong>Error!</strong> {!! !is_bool(Session::get('error')) && array_key_exists(Session::get('error'), $messages)? $messages[Session::get('error')] : Session::get('error') !!}
	</div>
	@elseif(Session::has('info'))
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<strong>Info!</strong> {!! array_key_exists(Session::get('info'), $messages)? $messages[Session::get('info')] : Session::get('info') !!}
	</div>
	@elseif(Session::has('success'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<strong>Success!</strong> {!! array_key_exists(Session::get('success'), $messages)? $messages[Session::get('success')] : Session::get('success') !!}
	</div>
	@elseif(Session::has('warning'))
	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<strong>Warning!</strong> {!! array_key_exists(Session::get('warning'), $messages)? $messages[Session::get('warning')] : Session::get('warning') !!}
	</div>
	@elseif($errors->has('error'))
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<span>
			<strong>Error(s):</strong>
			{!! implode('<br />', $errors->get('error')) !!}
		</span>
	</div>
	@endif
	</div>
</div>
@endif
<!-- END :: Notices -->

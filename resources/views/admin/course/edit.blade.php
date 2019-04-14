@include('admin/elements/header')
<?php
	$course = $page->getBody()->getDataByKey('course');
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>Edit Course</h1>
	  <ol class="breadcrumb">
		<li><a href="/course"><i class="fa fa-dashboard"></i> Course</a></li>
	  </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Edit Course</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					{!! Form::model($course, ['name'=>'edit', 'method'=>'PUT', 'url'=>'course/' . $course->id, 'class'=>'form-horizontal']) !!}
					  <div class="box-body">
						<div class="form-group{{ ($errors->has('course_name'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">Course Name</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="course_name" name="course_name" placeholder="Enter course name" value="{{ $course['course_name'] }}">
							@if ($errors->has('course_name'))
									<span class="help-block">{{ $errors->first('course_name') }}</span>
								@endif
								</div>
						</div>
						<div class="form-group{{ ($errors->has('course_code'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">Course Code</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="course_code" name="course_code" placeholder="Enter course code" value="{{ $course['course_code'] }}">
							@if ($errors->has('course_code'))
									<span class="help-block">{{ $errors->first('course_code') }}</span>
								@endif
								</div>
						</div>
						<div class="form-group{{ ($errors->has('description'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
						  <div class="col-sm-8">
							<textarea type="text" class="form-control" id="description" name="description" placeholder="Enter course name" >{{ $course['description'] }}</textarea>
							@if ($errors->has('description'))
									<span class="help-block">{{ $errors->first('description') }}</span>
								@endif
								</div>
						</div>
						<div class="form-group {{ ($errors->has('is_active'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">Is Active</label>
						  <div class="col-sm-8">
						  <?php $is_active = array_key_exists('is_active', Input::old())? Input::old('is_active') : $course->is_active; ?>
						  <div class="radio-list">
								<label class="radio-inline">
									<input type="radio" name="is_active" value="1" {{ ($is_active == 1)?  'checked="checked"' : '' }} /> Yes
								</label>
								<label class="radio-inline">
									<input type="radio" name="is_active" value="0" {{ ($is_active == 0)? 'checked="checked"' : '' }} /> No
								</label>
							</div>
							@if ($errors->has('is_active'))
									<span class="help-block">{{ $errors->first('is_active') }}</span>
							@endif
					  	</div>
						</div>
						
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<a href="{{ URL::previous() }}">
							<input type="button" class="btn btn-default" value="Cancel">
						</a>
						<input type="submit" class="btn btn-info" id="btn_update" name="btn_update" value="Update">
					  </div><!-- /.box-footer -->
						{!! Form::close() !!}
				</div><!-- /.box -->
			</div><!--/.col (right) -->
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div>
@include('admin/elements/footer')
@include('admin/elements/header')
<?php
	$course = $page->getBody()->getDataByKey('course');
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>{{ $course->name }}</h1>
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
					  <h3 class="box-title">Course Details</h3>
					</div><!-- /.box-header -->
					@include('admin/elements/notices')
					<!-- form start -->
					  <div class="box-body">
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">Course Name</label>
						  <div class="col-sm-10">
							<p> {{ $course['course_name'] }} </p>
					  	  </div>
						</div>
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">Course Code</label>
						  <div class="col-sm-10">
							<p> {{ $course['course_code'] }} </p>
					  	  </div>
						</div>
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
						  <div class="col-sm-10">
							<p> {{ $course['description'] }}</p>
					  	  </div>
						</div>
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">Is Active</label>
						  <?php $is_active = array_key_exists('is_active', Input::old())? Input::old('is_active') : $course->is_active; ?>
						  <div class="col-sm-10">
						  {{ ($is_active == 1)?  'Yes' : 'No' }}
							</div>
					  	  </div>
						</div>
						
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<a href="{{ URL::to('course') }}">
							<input type="button" class="btn btn-default" value="Listing">
						</a>
					  </div><!-- /.box-footer -->
				</div><!-- /.box -->
			</div><!--/.col (right) -->
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div>
@include('admin/elements/footer')

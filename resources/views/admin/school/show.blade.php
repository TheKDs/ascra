@include('admin/elements/header')
<?php
	$school = $page->getBody()->getDataByKey('school');
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>{{ $school->name }}</h1>
	  <ol class="breadcrumb">
		<li><a href="/school"><i class="fa fa-dashboard"></i> School</a></li>
	  </ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">School Details</h3>
					</div><!-- /.box-header -->
					@include('admin/elements/notices')
					<!-- form start -->
					  <div class="box-body">
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">School Name</label>
						  <div class="col-sm-10">
							<p> {{ $school['name'] }} </p>
					  	  </div>
						</div>
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">School Contact</label>
						  <div class="col-sm-10">
							<p> {{ $school['mobile'] }} </p>
					  	  </div>
						</div>
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">School Address</label>
						  <div class="col-sm-10">
							<p> {{ $school['address'] }}</p>
					  	  </div>
						</div>
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">Courses</label>
						  <div class="col-sm-10">
								@if($school->courses)
								@foreach ($school->courses as $course)
								<p> {{ $course->course_name }}</p>
								@endforeach
								@endif
								</div>
						</div>
						
						<div class="form-group">
						  <label for="inputEmail3" class="col-sm-2 control-label">Is Active</label>
						  <?php $is_active = array_key_exists('is_active', Input::old())? Input::old('is_active') : $school->is_active; ?>
						  <div class="col-sm-10">
						  {{ ($is_active == 1)?  'Yes' : 'No' }}
							</div>
					  	  </div>
						</div>
						
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<a href="{{ URL::to('school') }}">
							<input type="button" class="btn btn-default" value="Listing">
						</a>
						<a href="{{ URL::to('school',$school->id).'/edit' }}">
							<input type="button" class="btn btn-danger" value="Edit">
						</a>
					  </div><!-- /.box-footer -->
				</div><!-- /.box -->
			</div><!--/.col (right) -->
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div>
@include('admin/elements/footer')

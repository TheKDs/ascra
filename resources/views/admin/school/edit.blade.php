@include('admin/elements/header')
{!! HTML::style('public/plugins/select2/css/select2.min.css') !!}
{!! HTML::style('public/plugins/select2/css/select2-bootstrap.min.css') !!}
<?php
	$school = $page->getBody()->getDataByKey('school');
	$courseIds = $page->getBody()->getDataByKey('courseIds');
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>Edit School</h1>
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
					  <h3 class="box-title">Edit School</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					{!! Form::model($school, ['name'=>'edit', 'method'=>'PUT', 'url'=>'school/' . $school->id, 'class'=>'form-horizontal']) !!}
					  <div class="box-body">
						<div class="form-group{{ ($errors->has('name'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">School Name</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter school name" value="{{ $school['name'] }}">
							@if ($errors->has('name'))
									<span class="help-block">{{ $errors->first('name') }}</span>
								@endif
								</div>
						</div>
						<div class="form-group{{ ($errors->has('course'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">School</label>
						  <div class="col-sm-8">
							<select name="course_id[]" id="select2_course" class="form-control" multiple="true">
									@if ($courseIds)
									@foreach ($courseIds as $course)
											<option value="{{ $course['id']  }}" selected="selected">{{ $course['course_name'] }}</option>
									@endforeach
									@else
									<option></option>
									@endif
							</select>
							@if ($errors->has('course'))
								<span class="help-block">{{ $errors->first('course') }}</span>
							@endif
							</div>
						</div>
						<div class="form-group{{ ($errors->has('mobile'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">School Contact</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter school contact" value="{{ $school['mobile'] }}">
							@if ($errors->has('mobile'))
									<span class="help-block">{{ $errors->first('mobile') }}</span>
								@endif
								</div>
						</div>
						<div class="form-group{{ ($errors->has('address'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">School Address</label>
						  <div class="col-sm-8">
							<textarea type="text" class="form-control" id="address" name="address" placeholder="Enter school name" >{{ $school['address'] }}</textarea>
							@if ($errors->has('address'))
									<span class="help-block">{{ $errors->first('address') }}</span>
								@endif
								</div>
						</div>
						<div class="form-group {{ ($errors->has('is_active'))? ' has-error':'' }}">
						  <label for="inputEmail3" class="col-sm-2 control-label">Is Active</label>
						  <div class="col-sm-8">
						  <?php $is_active = array_key_exists('is_active', Input::old())? Input::old('is_active') : $school->is_active; ?>
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
{!! HTML::script('public/plugins/select2/js/select2.full.min.js') !!}
{!! HTML::script('public/scripts/school/components-dropdowns.js') !!}

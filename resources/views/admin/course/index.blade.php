@include('admin/elements/header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>Manage Course</h1>
	</section>
<?php
$courses = $page->getBody()->getDataByKey('courses');
?>
	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  	<div class="box">
			<div class="box-header">
			  <h3 class="box-title">Manage Course</h3>
				<div class="actions">
					<a href="course/create">	
						<input type="button" class="btn btn-info pull-right" id="btn_update" name="btn_update" value="Add">
					</a>
				</div>
			</div><!-- /.box-header -->
			@include('admin/elements/notices')
			<div class="box-body">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th>&nbsp;</th>
					<th>Course Name</th>
					<th>Course Code</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php if($courses){
				foreach($courses as $row){?>
					<tr>
						<td><span class="label label-sm {{ ($row['is_active'] == 1) ? 'bg-green' : 'bg-red' }}">{{ ($row['is_active'] == 1) ? 'Active' : 'Inactive' }}</span></td>
						<td>{{ $row['course_name'] }}</td>
						<td>{{ $row['course_name'] }}</td>
						<td>
							<a href="course/{{ $row['id'] }}/edit">
								<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
							</a>
							<a href="course/{{ $row['id'] }}">
								<i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>
							</a>
							<a onclick="" class="confirmDelete" id="{{ $row['id'] }}">
								<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
							</a>
							
						</td>
					</tr>
				<?php }}?> 
				</tbody>
				<tfoot>
				  <tr>
					<th>&nbsp;</th>
					<th>Course Name</th>
					<th>Course Code</th>
					<th>Action</th>
				  </tr>
				</tfoot>
			  </table>
				{!! Form::open(['method'=>'DELETE', 'url'=>'course', 'id'=>'DeleteForm']) !!}
				{!! Form::close() !!}
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@include('admin/elements/footer')
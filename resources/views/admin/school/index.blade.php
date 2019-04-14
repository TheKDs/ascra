@include('admin/elements/header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>Manage School</h1>
	</section>
<?php
$schools = $page->getBody()->getDataByKey('schools');
?>
	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  	<div class="box">
			<div class="box-header">
			  <h3 class="box-title">Manage School</h3>
				<div class="actions">
					<a href="school/create">	
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
					<th>School Name</th>
					<th>Contact</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				<?php if($schools){
				foreach($schools as $row){?>
					<tr>
						<td><span class="label label-sm {{ ($row['is_active'] == 1) ? 'bg-green' : 'bg-red' }}">{{ ($row['is_active'] == 1) ? 'Active' : 'Inactive' }}</span></td>
						<td>{{ $row['name'] }}</td>
						<td>{{ $row['mobile'] }}</td>
						<td>
							<a href="school/{{ $row['id'] }}/edit">
								<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
							</a>
							<a href="school/{{ $row['id'] }}">
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
					<th>School Name</th>
					<th>Contact</th>
					<th>Action</th>
				  </tr>
				</tfoot>
			  </table>
				{!! Form::open(['method'=>'DELETE', 'url'=>'school', 'id'=>'DeleteForm']) !!}
				{!! Form::close() !!}
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@include('admin/elements/footer')
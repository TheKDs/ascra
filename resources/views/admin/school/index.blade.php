@include('admin/elements/header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>Manage School</h1>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  	<div class="box">
			<div class="box-header">
			  <h3 class="box-title">Manage School</h3>
			</div><!-- /.box-header -->
			
			<div class="box-body">
			  <table id="datatable_ajax" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th>&nbsp;</th>
					<th>School Name</th>
					<th>Contact</th>
					<th>Action</th>
				  </tr>
				</thead>
				<tbody>
				
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
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.col -->
	  </div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@include('admin/elements/footer')
<script src="public/scripts/school/table-datatables-ajax.js"></script>
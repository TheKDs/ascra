<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 2.3.0
	</div>
	<strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>

<!-- Bootstrap 3.3.5 -->
<script src="{{ url('public/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->

<script src="{{ url('public/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ url('public/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
<script src="{{ url('public/plugins/bootbox/bootbox.min.js') }}"></script>

<script src="{{ url('public/scripts/app.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ url('public/plugins/morris/morris.min.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ url('public/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ url('public/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ url('public/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('public/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('public/assets/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('public/assets/js/demo.js') }}"></script>
<script src="{{ url('public/scripts/delete-alert-dialog.js') }}"></script>
<script>
    $(function () {
			$("#example1").DataTable();
    });
</script>
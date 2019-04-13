@section('pageHeadSpecificPluginCSS') {{-- Page Head Specific Plugin CSS Files --}}
	{!! HTML::style('assets/metronic/global/plugins/datatables/datatables.min.css') !!}
	{!! HTML::style('assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
@stop

@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
@stop

@section('bodyContent')	{{-- Page Body Content --}}
<?php $report = Session::has('report') ? Session::get('report') : null; ?>
	@if ($report)
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		Success: {{ count($report['success']) }}<br />
		Fail: {{ count($report['fail']) }}<br />
		@if (count($report['fail']))
		<ul>
			@foreach ($report['fail'] as $scrip_no=>$data)
			<li>
				{{ $data['type'] }}<br />
				<ul>
					@foreach ($data['messages'] as $col=>$messages)
					<li>{{ $col }}: {{ $messages[0] }}</li>
					@endforeach
				</ul>
			</li>
			@endforeach
		</ul>
		@endif
	</div>
	@endif
	<div class="portlet light portlet-fit portlet-datatable bordered bg-inverse">
		<div class="portlet-title" style="margin-bottom: 0px; padding-bottom: 0px;">
			<div class="caption">
				<i class="fa fa-list"></i>List of Loans
			</div>
			<div class="actions">
				<a href="loan/create" alt="Add" class="btn btn-sm green-haze btn-outline">
					<i class="fa fa-plus"></i>
					<span class="hidden-480">Add New</span>
				</a>
                                <a href="loan/bulk-upload" alt="Bulk Upload" class="btn btn-sm purple-wisteria btn-outline">
					<i class="fa fa-upload"></i>
					<span class="hidden-480">Bulk Upload</span>
				</a>
			</div>
		</div>
		<div class="portlet-body" style="padding-top: 0px;">
			<div class="table-container">
				<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
					<thead>
						<tr role="row" class="heading">
							<th class="col-md-1" style="background-color: #EEE; text-align: center; vertical-align: middle;">&nbsp;</th>
							<th class="col-md-1" style="background-color: #EEE; text-align: center; vertical-align: middle;">Name</th>
							<th class="col-md-1" style="background-color: #EEE; text-align: center; vertical-align: middle;">Type</th>
							<th class="col-md-1" style="background-color: #EEE; text-align: center; vertical-align: middle;">Interest<br />Rate (%)</th>
							<th class="col-md-1" style="background-color: #EEE; text-align: center; vertical-align: middle;">Loan Term</th>
							<th class="col-md-1" style="background-color: #EEE;">&nbsp;</th>
						</tr>
					</thead>
					<tbody> </tbody>
				</table>
				{!! Form::open(['method'=>'DELETE', 'url'=>'loan/', 'id'=>'DeleteForm']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop

@section('pageFooterSpecificPlugin')	{{-- Page Footer Specific Plugin Files --}}
	{!! HTML::script('assets/metronic/global/scripts/datatable.js') !!}
	{!! HTML::script('assets/metronic/global/plugins/datatables/datatables.min.js') !!}
	{!! HTML::script('assets/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
	{!! HTML::script('assets/metronic/global/plugins/bootbox/bootbox.min.js') !!}
@stop

@section('pageFooterSpecificJS')	{{-- Page Footer Specific JS Files --}}
	{!! HTML::script('assets/admin/scripts/loan/table-datatables-ajax.js') !!}
	{!! HTML::script('assets/admin/scripts/general-ui-alert-dialog.js') !!}
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
@stop

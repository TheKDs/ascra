@extends('admin.layout.twoColumn')

@section('pageHeadSpecificPluginCSS') {{-- Page Head Specific Plugin CSS Files --}}
@stop

@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
@stop

@section('bodyContent')	{{-- Page Body Content --}}
<?php
	$loan = $page->getBody()->getDataByKey('loan');
?>
	<div class="portlet light bg-inverse">
		<div class="portlet-body form">
			<!-- START :: Form -->
			 <form action="#" class="form-horizontal">
				<div class="form-body">
					<h2 class="margin-bottom-20">{{ $loan->type }}</h2>
					<!-- START :: row -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Name:</label>
								<div class="col-md-9">
									<p class="form-control-static">{{ $loan->name }}</p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Type:</label>
								<div class="col-md-9">
									<p class="form-control-static">{{ $loan->type }}</p>
								</div>
							</div>
						</div>
                        {{-- <!-- <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Amount:</label>
								<div class="col-md-9">
									<p class="form-control-static">INR {{ $loan->amount }}</p>
								</div>
							</div>
						</div> --> --}}
					</div>
					<!-- END :: row -->
					<!-- START :: row -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Loan Term:</label>
								<div class="col-md-9">
									<p class="form-control-static">{{ $loan->loan_term }}</p>
								</div>
							</div>
						</div>
                                                
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Interest Rate (%):</label>
								<div class="col-md-9">
									<p class="form-control-static">{{ $loan->interest_rate }}</p>
								</div>
							</div>
						</div>
					</div>
					<!-- END :: row -->
					<!-- START :: row -->
					{{-- <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Down Payment:</label>
								<div class="col-md-9">
									<p class="form-control-static">INR {{ $loan->down_payment }}</p>
								</div>
							</div>
						</div>
                                                
                                                <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Annual Payment:</label>
								<div class="col-md-9">
									<p class="form-control-static">INR {{ $loan->annual_payment }}</p>
								</div>
							</div>
						</div>
					</div> --}}
					<!-- END :: row -->
					<!-- START :: row -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Status:</label>
								<div class="col-md-9">
									<p class="form-control-static">{{ $loan->is_active? 'Active' : 'In-active' }}</p>
								</div>
							</div>
						</div>
					</div>
					<!-- END :: row -->
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<a href="{!! URL::to('loan') !!}" class="btn blue-madison btn-outline"><i class="fa fa-list"></i> Listing</a>
									<a href="{!! URL::to('loan/' . $loan->id . '/edit') !!}" class="btn yellow btn-outline"><i class="fa fa-pencil"></i> Edit</a>
									<a title="Delete" id="{{ $loan->id }}" class="confirmDelete btn btn-outline red" ><i class="fa fa-trash-o"></i> Delete</a>
									<a href="{!! URL::previous() !!}" class="btn dark btn-outline"><i class="fa fa-undo"></i> Cancel</a>
								</div>
							</div>
						</div>
						<div class="col-md-6"> </div>
					</div>
				</div>
			</form>
			<!-- END :: Form -->
			{!! Form::open(['method'=>'DELETE', 'id'=>'DeleteForm', 'url'=>'loan', 'style'=>'display:inline']) !!}
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('pageFooterSpecificPlugin')	{{-- Page Footer Specific Plugin Files --}}
	{!! HTML::script('assets/metronic/global/plugins/bootbox/bootbox.min.js') !!}
@stop

@section('pageFooterSpecificJS')	{{-- Page Footer Specific JS Files --}}
	{!! HTML::script('assets/admin/scripts/general-ui-alert-dialog.js') !!}
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
@stop

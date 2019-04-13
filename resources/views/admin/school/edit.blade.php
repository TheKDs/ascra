@extends('admin.layout.twoColumn')

@section('pageHeadSpecificPluginCSS') {{-- Page Head Specific Plugin CSS Files --}}
	{!! HTML::style('assets/metronic/global/plugins/select2/css/select2.min.css') !!}
	{!! HTML::style('assets/metronic/global/plugins/select2/css/select2-bootstrap.min.css') !!}
@stop

@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
@stop

@section('bodyContent')	{{-- Page Body Content --}}
<?php
	$loan = $page->getBody()->getDataByKey('loan');
?>
	<div class="portlet light bordered bg-inverse">
		<div class="portlet-body form">
			<!-- START :: Form -->
			{!! Form::model($loan, ['name'=>'edit', 'method'=>'PUT', 'url'=>'loan/' . $loan->id, 'class'=>'form-horizontal']) !!}
				<div class="form-body">
					<h3 class="form-section">{{ $loan->type }}</h3>
					<!-- START :: row -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group{{ ($errors->has('name'))? ' has-error':'' }}">
								<label for="name" class="control-label col-md-3">
									Name
									<span class="required" aria-required="true">*</span>
								</label>
								<div class="col-md-9">
									{!! Form::text('name', Input::old('name'), ['class'=>'form-control', 'placeholder'=>'Max 100 characters']) !!}
								@if ($errors->has('name'))
									<span class="help-block">{{ $errors->first('name') }}</span>
								@endif
								</div>
							</div>
						</div>
						<?php
							$type = [
								'' => '',
								'Home Loan' => 'Home Loan',
								'Car Loan' => 'Car Loan',
								'Personal Loan' => 'Personal Loan'
							];
						?>
						<div class="col-md-6">
							<div class="form-group{{ ($errors->has('type'))? ' has-error':'' }}">
								<label for="type" class="control-label col-md-3">
									Loan Type
									<span class="required" aria-required="true">*</span>
								</label>
								<div class="col-md-9">
									{!! Form::select('type', $type, Input::old('type'), ['class'=>'form-control', 'id'=>'select2_type_class']) !!}
									{{-- {!! Form::text('type', Input::old('type'), ['class'=>'form-control', 'placeholder'=>'Max 100 characters']) !!} --}}
								@if ($errors->has('type'))
									<span class="help-block">{{ $errors->first('type') }}</span>
								@endif
								</div>
							</div>
						</div>
                        {{-- <div class="col-md-6">
							<div class="form-group{{ ($errors->has('amount'))? ' has-error':'' }}">
								<label for="amount" class="control-label col-md-3">
									Amount (Rs.)
									<span class="required" aria-required="true">*</span>
								</label>
								<div class="col-md-9">
									{!! Form::text('amount', Input::old('amount'), ['class'=>'form-control']) !!}
								@if ($errors->has('amount'))
									<span class="help-block">{{ $errors->first('amount') }}</span>
								@endif
								</div>
							</div>
						</div> --}}
					</div>
					<!-- END :: row -->
                                        <!-- START :: row -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group{{ ($errors->has('loan_term'))? ' has-error':'' }}">
								<label for="loan_term" class="control-label col-md-3">
									Loan Term
								</label>
								<div class="col-md-9">
									{!! Form::text('loan_term', Input::old('loan_term'), ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
								@if ($errors->has('loan_term'))
									<span class="help-block">{{ $errors->first('loan_term') }}</span>
								@endif
								</div>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group{{ ($errors->has('interest_rate'))? ' has-error':'' }}">
								<label for="interest_rate" class="control-label col-md-3">
									Interest Rate (%)
									<span class="required" aria-required="true">*</span>
								</label>
								<div class="col-md-9">
									{!! Form::text('interest_rate', Input::old('interest_rate'), ['class'=>'form-control', 'placeholder'=>'Max value: 99.99']) !!}
								@if ($errors->has('interest_rate'))
									<span class="help-block">{{ $errors->first('interest_rate') }}</span>
								@endif
								</div>
							</div>
						</div>
					</div>
					<!-- END :: row -->
					<!-- START :: row -->
					{{-- <div class="row">
						<div class="col-md-6">
							<div class="form-group{{ ($errors->has('down_payment'))? ' has-error':'' }}">
								<label for="down_payment" class="control-label col-md-3">
									 Down Payment(Rs.)
								</label>
								<div class="col-md-9">
									{!! Form::text('down_payment', Input::old('down_payment'), ['class'=>'form-control']) !!}
								@if ($errors->has('down_payment'))
									<span class="help-block">{{ $errors->first('down_payment') }}</span>
								@endif
								</div>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group{{ ($errors->has('annual_payment'))? ' has-error':'' }}">
								<label for="annual_payment" class="control-label col-md-3">
									 Annual Payment (Rs.)
								</label>
								<div class="col-md-9">
									{!! Form::text('annual_payment', Input::old('annual_payment'), ['class'=>'form-control']) !!}
								@if ($errors->has('annual_payment'))
									<span class="help-block">{{ $errors->first('annual_payment') }}</span>
								@endif
								</div>
							</div>
						</div>
					</div>  --}}
					<!-- END :: row -->
					<!-- START :: row -->
					<div class="row">
						<div class="col-md-6">
						<?php $is_active = array_key_exists('is_active', Input::old())? Input::old('is_active') : $loan->is_active; ?>
							<div class="form-group{{ ($errors->has('is_active'))? ' has-error':'' }}">
								{!! Form::label('is_active', 'Active', ['class'=>'control-label col-md-3']) !!}
								<div class="col-md-offset-1 col-md-8">
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
						</div>
					</div>
					<!-- END :: row -->
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn green btn-outline"><i class="fa fa-save"></i> Submit</button>
									<a href="{{ URL::previous() }}" class="btn dark btn-outline"><i class="fa fa-undo"></i> Cancel</a>
								</div>
							</div>
						</div>
						<div class="col-md-6"></div>
					</div>
				</div>
			{!! Form::close() !!}
			<!-- END :: Form -->
		</div>
	</div>
@stop

@section('pageFooterSpecificPlugin')	{{-- Page Footer Specific Plugin Files --}}
	{!! HTML::script('assets/metronic/global/plugins/select2/js/select2.full.min.js') !!}
@stop

@section('pageFooterSpecificJS')	{{-- Page Footer Specific JS Files --}}
	{!! HTML::script('assets/admin/scripts/loan/components-dropdowns.js') !!}
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
@stop

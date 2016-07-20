@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>{{ trans('hackerspacecrm.pages.titles.settings') }}</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-default col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('hackerspacecrm.pages.subtitles.generalsettings') }}</h3>
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
						<form role="form" action="{{ url('/settings/general') }}" method="POST">
							{!! method_field('PATCH') !!}
							{!! csrf_field() !!}
							<div class="box-body">
								<div class="row">

									<div class="col-md-4">
										<label for="crmname">{{ trans('hackerspacecrm.forms.labels.crmname') }}*</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('crmname') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="crmname" name="crmname" placeholder="Hackerspace CRM" value="{{ old('crmname') ? old('crmname') : $settings['crmname'] }}" required/>
											@if ($errors->has('crmname'))
											<span class="help-block">
												<strong>{{ $errors->first('crmname') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<label for="crmdescription">{{ trans('hackerspacecrm.forms.labels.crmdescription') }}*</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('crmdescription') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="crmdescription" name="crmdescription" placeholder="{{ trans('hackerspacecrm.forms.placeholders.example_u') }}" value="{{ old('crmdescription') ? old('crmdescription') : $settings['crmdescription'] }}" required>
											@if ($errors->has('crmdescription'))
											<span class="help-block">
												<strong>{{ $errors->first('crmdescription') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<br style="clear:both;" /><hr><br />

									<div class="col-md-4">
										<label for="orgname">{{ trans('hackerspacecrm.forms.labels.orgname') }}*</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('orgname') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="orgname" name="orgname" placeholder="Hackerspace CRM" value="{{ old('orgname') ? old('orgname') : $settings['orgname'] }}" required/>
											@if ($errors->has('orgname'))
											<span class="help-block">
												<strong>{{ $errors->first('orgname') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<label for="orgdescription">{{ trans('hackerspacecrm.forms.labels.orgdescription') }}</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('orgdescription') ? ' has-error' : ' has-feedback' }}">
											<input type="text" class="form-control" id="orgdescription" name="orgdescription" placeholder="Hackerspace CRM" value="{{ old('orgdescription') ? old('orgdescription') : $settings['orgdescription'] }}"/>
											@if ($errors->has('orgdescription'))
											<span class="help-block">
												<strong>{{ $errors->first('orgdescription') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<label for="address">{{ trans('hackerspacecrm.forms.labels.hsorgaddress') }}</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('address') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="address" type="text" name="address"/>{{ old('address') ? old('address') : $settings['address'] }}</textarea>
											@if ($errors->has('address'))
											<span class="help-block">
												<strong>{{ $errors->first('address') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<br style="clear:both;" /><hr><br />

									<div class="col-md-4">
										<label for="locale">{{ trans('hackerspacecrm.forms.labels.defaultlocale') }}*</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('locale') ? ' has-error' : ' has-feedback' }}">
											<select widthclass="form-control" id="locale" name="locale" class="form-control">
												@foreach (array_keys(crminfo('supported_locales')) as $key)
													<option value="{{ $key }}" {{ old('locale') == $key ? "selected" : ($settings['locale'] == $key ? "selected" : "") }}>{{ $key }}</option>
												@endforeach
											</select>
											@if ($errors->has('locale'))
											<span class="help-block">
												<strong>{{ $errors->first('locale') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<label for="enable_registration">{{ trans('hackerspacecrm.forms.labels.registration') }}</label><br />
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('enable_registration') ? ' has-error' : ' has-feedback' }}">
											<input type="checkbox" class="minimal" id="enable_registration" name="enable_registration" {{ old('enable_registration') ? old('enable_registration') : ($settings['enable_registration'] == 1 ? 'checked' : "") }} value="1"> {{ trans('hackerspacecrm.forms.checkboxes.anyonecanregister') }}
											@if ($errors->has('enable_registration'))
											<span class="help-block">
												<strong>{{ $errors->first('enable_registration') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<label for="new_user_role">{{ trans('hackerspacecrm.forms.labels.newuserrole') }}*</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('new_user_role') ? ' has-error' : ' has-feedback' }}">
											<select class="form-control" id="new_user_role" name="new_user_role" required>
												<option disabled selected>{{ trans('hackerspacecrm.forms.dropdowns.selectrole') }}</option>
												@foreach (crmRoles() as $role)
													<option value="{{ $role->name }}" {{ old('new_user_role') == $role->name ? "selected" : ($settings['new_user_role'] == $role->name ? "selected" : "") }}>{{ $role->name . ' - ' .$role->label }}</option>
												@endforeach
											</select>
											@if ($errors->has('new_user_role'))
											<span class="help-block">
												<strong>{{ $errors->first('new_user_role') }}</strong>
											</span>
											@endif
										</div>
									</div>

									<div class="col-md-4">
										<label for="url">{{ trans('hackerspacecrm.forms.labels.appurl') }}*</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('url') ? ' has-error' : ' has-feedback' }}">
											<input class="form-control" id="url" placeholder="http://www.example.com/" type="text" name="url"  value="{{ old('url') ? old('url') : $settings['url'] }}" required/>
											@if ($errors->has('url'))
											<span class="help-block">
												<strong>{{ $errors->first('url') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-4">
										<label for="crmfooter">{{ trans('hackerspacecrm.forms.labels.footercontent') }}*</label>
									</div>
									<div class="col-md-8">
										<div class="form-group {{ $errors->has('crmfooter') ? ' has-error' : ' has-feedback' }}">
											<textarea class="form-control" id="crmfooter" placeholder="Powered by Hackerspace CRM." type="text" name="crmfooter" required/>{{ old('crmfooter') ? old('crmfooter') : $settings['crmfooter'] }}</textarea>
											@if ($errors->has('crmfooter'))
											<span class="help-block">
												<strong>{{ $errors->first('crmfooter') }}</strong>
											</span>
											@endif
										</div>
									</div>

								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-primary">{{ trans('hackerspacecrm.forms.buttons.update') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- iCheck -->
<script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
<script>
	//iCheck for checkbox and radio inputs
	// $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	//   checkboxClass: 'icheckbox_minimal-blue',
	//   radioClass: 'iradio_minimal-blue'
	// });
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	});
</script>
@stop
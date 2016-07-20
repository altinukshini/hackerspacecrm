@extends('layouts.standalone')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{ url('/') }}"><b>{{ crminfo('name') }}</b></a>
	</div><!-- /.login-logo -->
	<div class="login-box-body">

		<p class="login-box-msg">{{ trans('hackerspacecrm.pages.titles.resetpassword') }}</p>

		<form role="form" method="POST" action="{{ url('/password/reset') }}">
			{!! csrf_field() !!}

			<input type="hidden" name="token" value="{{ $token }}">
			
			<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
				<input type="email" class="form-control" name="email" placeholder="{{ trans('hackerspacecrm.forms.placeholders.email') }}" value="{{ $email or old('email') }}">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
				<input type="password" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.password') }}" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				@if ($errors->has('password'))
				<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
				<input type="password" class="form-control" placeholder="{{ trans('hackerspacecrm.forms.placeholders.passwordconfirmation') }}" name="password_confirmation">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				@if ($errors->has('password_confirmation'))
				<span class="help-block">
					<strong>{{ $errors->first('password_confirmation') }}</strong>
				</span>
				@endif
			</div>

			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-btn fa-refresh"></i> {{ trans('hackerspacecrm.forms.labels.resetpassword') }}</button>
				</div><!-- /.col -->
			</div>

		</form>
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->

@endsection
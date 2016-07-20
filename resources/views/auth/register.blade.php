@extends('layouts.standalone')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{ url('/') }}"><b>{{ crminfo('name') }}</b></a>
	</div><!-- /.login-logo -->
	<div class="login-box-body">

		<p class="login-box-msg">{{ trans('hackerspacecrm.pages.titles.register', ['name' => crminfo('name')]) }}</p>
		@include('includes.flash-standalone')

		<form role="form" method="POST" action="{{ url('/register') }}">
			{!! csrf_field() !!}


			<div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
				<input type="text" class="form-control" name="full_name" placeholder="{{ trans('hackerspacecrm.forms.placeholders.fullname') }}" value="{{ old('full_name') }}">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				@if ($errors->has('full_name'))
				<span class="help-block">
					<strong>{{ $errors->first('full_name') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('username') ? ' has-error' : ' has-feedback' }}">
				<input type="text" class="form-control" name="username" placeholder="{{ trans('hackerspacecrm.forms.placeholders.username') }}" value="{{ old('username') }}">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				@if ($errors->has('username'))
				<span class="help-block">
					<strong>{{ $errors->first('username') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
				<input type="email" class="form-control" name="email" placeholder="{{ trans('hackerspacecrm.forms.placeholders.email') }}" value="{{ old('email') }}">
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
					<button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-btn fa-user"></i> {{ trans('hackerspacecrm.forms.labels.register') }}</button>
				</div><!-- /.col -->
			</div>

		</form>
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->


@endsection





























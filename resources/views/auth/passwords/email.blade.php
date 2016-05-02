@extends('layouts.standalone')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="{{ url('/') }}"><b>{{ crminfo('name') }}</b></a>
	</div><!-- /.login-logo -->
	<div class="login-box-body">

		<p class="login-box-msg">Reset password</p>
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif

		<form role="form" method="POST" action="{{ url('/password/email') }}">
			{!! csrf_field() !!}


			<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
				<input type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>

			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-btn fa-envelope"></i> Send Password Reset Link</button>
				</div><!-- /.col -->
			</div>
		</form>

	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->


@endsection
@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Edit Account</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $user->full_name }}</h3>
				</div>
				<div class="box-body">
					
					<div class="row">
						<div class="col-md-6">
							<form role="form" method="POST" action="{{ url('users/'.$user->username) }}">
								{!! method_field('PATCH') !!}
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
									<label for="full_name">Full Name*</label>
									<input type="text" class="form-control" placeholder="Name Surname" name="full_name" value="{{ old('full_name') ? old('full_name') : $user->full_name }}" required>
									@if ($errors->has('full_name'))
									<span class="help-block">
										<strong>{{ $errors->first('full_name') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
									<label for="email">Email*</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
										<input type="email" class="form-control" placeholder="user@email.com" name="email" value="{{ old('email') ? old('email') : $user->email }}" required>
									</div>
									@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
						</div>
						<div class="col-md-6">
							<!-- <h4>Change password</h4> -->
							<form role="form" id="editPasswordForm" method="POST" action="{{ url('users/'.$user->username.'/password') }}">
								{!! method_field('PATCH') !!}
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
									<label for="password">New password*</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										<input type="password" class="form-control" name="password" value="" required>
									</div>
									@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
									<label for="password_confirmation">Confirm new password*</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										<input type="password" class="form-control" name="password_confirmation" value="" required>
									</div>
									@if ($errors->has('password_confirmation'))
									<span class="help-block">
										<strong>{{ $errors->first('password_confirmation') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Change</button>
								</div>
							</form>
						</div>
					</div>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section><!-- /.content -->

@stop
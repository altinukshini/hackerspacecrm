@extends('layouts.standalone')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>Hackerspace</b> CRM</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">

    <p class="login-box-msg">Sign in to enter the CRM</p>

    <form role="form" method="POST" action="{{ url('/login') }}">
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

      <div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-btn fa-sign-in"></i> Login</button>
        </div><!-- /.col -->
      </div>
    </form>
    <a href="{{ url('/register') }}">Register</a><br>
    <a href="{{ url('/password/reset') }}">Forgot Your Password?</a><br>
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->


@endsection

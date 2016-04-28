@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Settings</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-default col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title">General CRM Settings</h3>
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
						<form role="form" class="">
						  {!! csrf_field() !!}

						  <div class="box-body">

							<div class="form-group {{ $errors->has('appname') ? ' has-error' : ' has-feedback' }}">
							  <label for="appname">Application name</label>
							  <input class="form-control" id="appname" placeholder="Hackerspace CRM" type="text" required>
							  @if ($errors->has('appname'))
							      <span class="help-block">
							          <strong>{{ $errors->first('appname') }}</strong>
							      </span>
							  @endif
							</div>

							<div class="form-group {{ $errors->has('appfooter') ? ' has-error' : ' has-feedback' }}">
							  <label for="appfooter">Footer content</label>
							  <input class="form-control" id="appfooter" placeholder="© 2015-2016 Hackerspace CRM. CC-BY-SA." type="text" required>
							  @if ($errors->has('appfooter'))
							      <span class="help-block">
							          <strong>{{ $errors->first('appfooter') }}</strong>
							      </span>
							  @endif
							</div>

							<div class="form-group {{ $errors->has('defaultlocale') ? ' has-error' : ' has-feedback' }}">
							  <label for="defaultlocale">Default app locale</label>
							  <input class="form-control" id="defaultlocale" placeholder="en" type="text" required>
							  @if ($errors->has('defaultlocale'))
							      <span class="help-block">
							          <strong>{{ $errors->first('defaultlocale') }}</strong>
							      </span>
							  @endif
							</div>

						  </div>
						  <!-- /.box-body -->

						  <div class="box-footer">
							<button type="submit" class="btn btn-primary">Update</button>
						  </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@stop
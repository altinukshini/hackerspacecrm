@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Settings</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default col-md-6">
				<div class="box-header with-border">
					<h3 class="box-title">User emails</h3>
				</div>
				<div class="row">
					<div class="col-md-12 pull-left">
						<form role="form">
							{!! csrf_field() !!}
							<div class="box-body">
								<div class="form-group {{ $errors->has('welcomeemail') ? ' has-error' : ' has-feedback' }}">
									<h4>Welcome email</h4>
									<div class="box-body pad">
										<textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
									</div>
									@if ($errors->has('welcomeemail'))
									<span class="help-block">
										<strong>{{ $errors->first('welcomeemail') }}</strong>
									</span>
									@endif
								</div>

								<div class="form-group {{ $errors->has('confirmationemail') ? ' has-error' : ' has-feedback' }}">
									<h4>Confirmation email</h4>
									<div class="box-body pad">
										<textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
									</div>
									@if ($errors->has('confirmationemail'))
									<span class="help-block">
										<strong>{{ $errors->first('confirmationemail') }}</strong>
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

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
	$(function () {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('editor1');
		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5();
	});
</script>

@stop
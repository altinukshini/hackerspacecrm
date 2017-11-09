@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>{{ trans('hackerspacecrm.pages.titles.settings') }}</h1>
</section>

<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('hackerspacecrm.pages.subtitles.permissions') }}</h3>
		</div>
		<div class="box-body">
			<br style="clear:both;">
			@can('permission_update')
				<form role="form" id="updatePermissionsForm" method="POST" action="{{ url('permissions') }}">
					{!! csrf_field() !!}
					{!! method_field('PATCH') !!}
					<table class="table table-responsive no-padding table-hover">
						<tbody>
							<tr>
								<th></th>
								@foreach($roles as $role)
									<th class="text-center">{{ $role->label }}</th>
								@endforeach
							</tr>
							@foreach($permissions as $permission)
								<tr>
									<td>
										@can('permission_update')
											<button type="button" class="btn btn-xs btn-default btn-flat pull-left" data-toggle="tooltip" title="{{ trans('hackerspacecrm.forms.titles.edit') }}" onclick="editPermission('{{ url('permissions/'.$permission->id) }}', '{{ getCurrentSessionAppLocale() }}')"><i class="fa fa-edit text-blue"></i></button>
										@endcan
										<span class="pull-right">{{ $permission->label }}</span>
									</td>
									@foreach($roles as $role)
										<td class="text-center">
											<div class="form-group{{ $errors->has('enable_registration') ? ' has-error' : ' has-feedback' }}">
												<input type="checkbox" class="minimal" name="roles[{{ $role->id }}][{{ $permission->id }}]" value="{{ $permission->name }}" {{ $role->hasPermission($permission->id) ? 'checked' : '' }} {{ $role->name == 'administrator' ? 'disabled' : '' }}/>
											</div>
										</td>
									@endforeach
								</tr>
							@endforeach
						</tbody>
					</table>
					<br style="clear:both;">
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('hackerspacecrm.forms.buttons.save') }}</button>
					</div>
				</form>
			@endcan
		</div><!-- /.box-body -->
	</div><!-- /.box -->
	@can('permission_update')
		<div class="modal fade" tabindex="-1" role="dialog" id="editPermission">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('hackerspacecrm.pages.subtitles.editpermission') }}</h4>
						</div>
						<div class="modal-body">
							<form id="editPermissionForm" role="form" action="" METHOD='POST'>
								{!! method_field('PATCH') !!}
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has('label') ? ' has-error' : ' has-feedback' }}">
									<label for="label">{{ trans('hackerspacecrm.forms.labels.label') }}*</label>
									<input class="form-control" type="text" name="label" placeholder="{{ trans('hackerspacecrm.forms.placeholders.example_u') }}" value="{{ old('label') }}" required>
									
									@if ($errors->has('label'))
									<span class="help-block">
										<strong>{{ $errors->first('label') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('hackerspacecrm.forms.buttons.save') }}</button>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
		</div>
		<!-- If role create request has error, open aaddnewrole modal -->
		@if ($errors->has('error_code') AND $errors->first('error_code') == 6)
		<script type="text/javascript">
			$('#editPermission').modal('show');
		</script>
		@endif
	@endcan
</section><!-- /.content -->

@stop
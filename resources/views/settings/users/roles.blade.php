@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>{{ trans('hackerspacecrm.pages.titles.settings') }}</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('hackerspacecrm.pages.subtitles.userroles') }}</h3>
				</div>
				<div class="box-body">
					@can('role_update')
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{!! trans('hackerspacecrm.help.settings.roles') !!}
					</div>
					@endcan
					
					@can('role_create')
						<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewrole" style="clear:both;margin-bottom:10px;">
							<i class="fa fa-plus"></i> {{ trans('hackerspacecrm.forms.buttons.addnew') }}
						</a>
					@endcan
					
					<table class="table table-responsive no-padding table-hover">
						<tbody>
							<tr>
								<th>{{ trans('hackerspacecrm.forms.tables.columns.id') }}</th>
								<th>{{ trans('hackerspacecrm.forms.tables.columns.name') }}</th>
								<th>{{ trans('hackerspacecrm.forms.tables.columns.label') }}</th>
								<th>{{ trans('hackerspacecrm.forms.tables.columns.action') }}</th>
							</tr>
							@foreach($roles as $role)
								<tr>
									<td>{{ $role->id }}</td>
									<td>{{ $role->name }}</td>
									<td>{{ $role->label }}</td>
									<td>
										@if($role->name != 'administrator')
											@can('role_update')
												<button type="button" title="{{ trans('hackerspacecrm.forms.titles.edit') }}" class="btn btn-xs btn-default btn-flat" onclick="editRole('{{ url('roles/'.$role->id) }}')"><i class="fa fa-edit text-blue"></i></button>
											@endcan
											@can('role_delete')
												<button type="button" title="{{ trans('hackerspacecrm.forms.titles.delete') }}" data-rolename="{{ $role->name }}" data-roleid="{{ $role->id }}" data-roleurl="{{ url('roles/'.$role->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmRoleDelete"><i class="fa fa-trash text-red"></i></button>
											@endcan
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
	@can('role_delete')
		<div class="modal fade" tabindex="-1" role="dialog" id="confirmRoleDelete">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('hackerspacecrm.pages.subtitles.confirmroledeletion') }}</h4>
						</div>
						<div class="modal-body">
							<p>{{ trans('hackerspacecrm.forms.help.areyousure') }} <b><span id="rolename"></span></b>?</p>
							<p><b>{{ trans('hackerspacecrm.forms.labels.note') }}: </b>{{ trans('hackerspacecrm.forms.help.deletingrole') }}</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('hackerspacecrm.forms.buttons.close') }}</button>
							{!! Form::open(['method' => 'DELETE', 'id'=>'delForm']) !!}
							<button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('hackerspacecrm.forms.buttons.delete') }}</button>
							{!! Form::close() !!}
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
		</div>
	@endcan
	@can('role_create')
		<div class="modal fade" tabindex="-1" role="dialog" id="addnewrole">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('hackerspacecrm.pages.subtitles.creantenewrole') }}</h4>
						</div>
						<div class="modal-body">
							<form role="form" action="{{ url('roles') }}" METHOD='POST'>
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has('name') ? ' has-error' : ' has-feedback' }}">
									<label for="name">{{ trans('hackerspacecrm.forms.labels.name') }}*</label>
									<input class="form-control" type="text" name="name" placeholder="{{ trans('hackerspacecrm.forms.placeholders.example_l') }}"  value="{{ old('name') }}" required>
									<p>{{ trans('hackerspacecrm.forms.help.nospecialchar') }}</p>

									@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>
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
									<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ trans('hackerspacecrm.forms.buttons.create') }}</button>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
		</div>
		<!-- If role create request has error, open aaddnewrole modal -->
		@if ($errors->has('error_code') AND $errors->first('error_code') == 5)
		<script type="text/javascript">
			$('#addnewrole').modal('show');
		</script>
		@endif
	@endcan
	@can('role_update')
		<div class="modal fade" tabindex="-1" role="dialog" id="editRole">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">{{ trans('hackerspacecrm.pages.subtitles.editrole') }}</h4>
						</div>
						<div class="modal-body">
							<form id="editRoleForm" role="form" action="" METHOD='POST'>
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
			$('#editRole').modal('show');
		</script>
		@endif
	@endcan
</section><!-- /.content -->

@stop
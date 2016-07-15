@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Settings</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">User roles</h3>
				</div>
				<div class="box-body">
					@can('role_update')
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						We do not recommend deleting the default CRM roles, doing so may affect the CRM's behaviour. Please consider adding new ones instead.
					</div>
					@endcan
					
					@can('role_create')
						<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewrole" style="clear:both;margin-bottom:10px;">
							<i class="fa fa-plus"></i> Add new
						</a>
					@endcan
					
					<table class="table table-responsive no-padding table-hover">
						<tbody>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Label</th>
								<th>Action</th>
							</tr>
							@foreach($roles as $role)
								<tr>
									<td>{{ $role->id }}</td>
									<td>{{ $role->name }}</td>
									<td>{{ $role->label }}</td>
									<td>
										@if($role->name != 'administrator')
											@can('role_update')
												<button type="button" class="btn btn-xs btn-default btn-flat" onclick="editRole('{{ url('roles/'.$role->id) }}')"><i class="fa fa-edit text-blue"></i></button>
											@endcan
											@can('role_delete')
												<button type="button" data-rolename="{{ $role->name }}" data-roleid="{{ $role->id }}" data-roleurl="{{ url('roles/'.$role->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmRoleDelete"><i class="fa fa-trash text-red"></i></button>
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
							<h4 class="modal-title">Confirm role deletion</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure you want to delete role "<b><span id="rolename"></span></b>"?</p>
							<p><b>Note: </b>Deleting a role will remove all its relations with Permissions and CRM Users</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							{!! Form::open(['method' => 'DELETE', 'id'=>'delForm']) !!}
							<button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Delete</button>
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
							<h4 class="modal-title">Add new role</h4>
						</div>
						<div class="modal-body">
							<form role="form" action="{{ url('roles') }}" METHOD='POST'>
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has('name') ? ' has-error' : ' has-feedback' }}">
									<label for="name">Name*</label>
									<input class="form-control" type="text" name="name" placeholder="newname"  value="{{ old('name') }}" required>
									<p>The name should not contain spaces, special characters or capital letters. Only underscore "_" allowed.</p>

									@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group{{ $errors->has('label') ? ' has-error' : ' has-feedback' }}">
									<label for="label">Label*</label>
									<input class="form-control" type="text" name="label" placeholder="Example" value="{{ old('label') }}" required>
									
									@if ($errors->has('label'))
									<span class="help-block">
										<strong>{{ $errors->first('label') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
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
							<h4 class="modal-title">Edit role</h4>
						</div>
						<div class="modal-body">
							<form id="editRoleForm" role="form" action="" METHOD='POST'>
								{!! method_field('PATCH') !!}
								{!! csrf_field() !!}
								<div class="form-group{{ $errors->has('label') ? ' has-error' : ' has-feedback' }}">
									<label for="label">Label*</label>
									<input class="form-control" type="text" name="label" placeholder="Example" value="{{ old('label') }}" required>
									
									@if ($errors->has('label'))
									<span class="help-block">
										<strong>{{ $errors->first('label') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
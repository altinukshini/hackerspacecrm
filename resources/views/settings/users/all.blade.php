@extends('layouts.app')


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Settings</h1>
</section>

<section class="content">
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">All users</h3>
		</div>
		<div class="box-body">
			@can('user_create')
				<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewuser">
					<i class="fa fa-plus"></i> Add new
				</a>
			@endcan
			<br style="clear:both;">
			<br style="clear:both;">
			@can('user_view')
				<table id="alluserstable" class="table table-responsive table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Full name</th>
							<th>username</th>
							<th>email</th>
							<th>profile</th>
							<th>last login</th>
							<th>verified</th>
							<th>created at</th>
							@can('user_update')
								<th>action</th>
							@endcan
						</tr>
					</thead>
					<tbody>
						@foreach( $users as $user )
							<tr>
								<td {!! $user->username == crminfo('admin_username') ? 'style="background-color:#B5E4FF;"' : '' !!}>{{ $user->id }}</td>
								<td>{{ $user->full_name }}</td>
								<td>{{ $user->username }}</td>
								<td>{{ $user->email }}</td>
								<td>
									@can('user_view')
										{!! $user->hasProfile() ? '<a href="'.url($user->profilePath()).'"><i class="fa fa-external-link text-blue"></i></a>' :  '' !!}
									@endcan
									@can('profile_create')
										{!! $user->hasProfile() ? '' : '<a href="'.url("profiles/".$user->username."/create").'"><i class="fa fa-plus text-green"></i></a>' !!}
									@endcan
								</td>
								<td>{{ $user->last_login }}</td>
								<td>{!! $user->verified == 1 ? '<i class="fa fa-check text-green"></i>' : '<i class="fa fa-close text-red"></i>' !!}</td>
								<td>{{ $user->created_at }}</td>
								@can('user_update')
									<td>
										@can('role_update')
											@if($user->username != crminfo('admin_username'))
												<button type="button" class="btn btn-xs btn-warning btn-flat" onclick="editUserRoles('{{ $user->username }}')"><i class="fa fa-eye"></i> roles</button>
											@endif
										@endcan
										@can('user_update')
											<button type="button" class="btn btn-xs btn-default btn-flat" onclick="editUser('{{ $user->username }}')"><i class="fa fa-edit text-blue"></i></button>
										@endcan
										@can('user_delete')
											@if($user->username != crminfo('admin_username'))
												<button type="button" data-username="{{ $user->username }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmUserDelete"><i class="fa fa-trash text-red"></i></button>
											@endif
										@endcan
									</td>
								@endcan
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>Full name</th>
							<th>username</th>
							<th>email</th>
							<th>profile</th>
							<th>last login</th>
							<th>verified</th>
							<th>created at</th>
							@can('user_update')
								<th>action</th>
							@endcan
						</tr>
					</tfoot>
				</table>
			@endcan
		</div><!-- /.box-body -->
	</div><!-- /.box -->
	@can('user_create')
		<div class="modal fade" tabindex="-1" role="dialog" id="addnewuser">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Create new user</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<form role="form" id="addNewUserForm" method="POST" action="{{ url('users') }}">
								{!! csrf_field() !!}
								<div class="col-md-6">
										
									<div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
										<label for="full_name">Full Name*</label>
										<input type="text" class="form-control" placeholder="Name Surname" name="full_name" value="{{ old('full_name') ? old('full_name') : '' }}" required>
										@if ($errors->has('full_name'))
										<span class="help-block">
											<strong>{{ $errors->first('full_name') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('username') ? ' has-error' : ' has-feedback' }}">
										<label for="username">Username*</label>
										<input type="text" class="form-control" placeholder="Name Surname" name="username" value="{{ old('username') ? old('username') : '' }}" required>
										@if ($errors->has('username'))
										<span class="help-block">
											<strong>{{ $errors->first('username') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
										<label for="email">Email*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<input type="email" class="form-control" placeholder="user@email.com" name="email" value="{{ old('email') ? old('email') : '' }}" required>
										</div>
										@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
										@endif
									</div>
									
					              <div class="clearfix"></div><br />
									
								</div>
								<div class="col-md-6">
									<div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
										<label for="password">Password*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
											<input type="password" class="form-control genpasswd" name="password" data-size="11" data-character-set="a-z,A-Z"  value="{{ old('password') }}" required>
										</div>
										@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
										<label for="password_confirmation">Confirm password*</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
											<input type="password" class="form-control genpasswd" name="password_confirmation" data-size="11" data-character-set="a-z,A-Z"  value="{{ old('password_confirmation') }}" required>
										</div>
										@if ($errors->has('password_confirmation'))
										<span class="help-block">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group">
										<button type="button" class="btn btn-default btn-sm btn-genpasswd">Generate password</button>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="checkbox" class="minimal margin-r-5" name="notify" value="yes"/>&nbsp;Notify new user for their new account.<br />
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		</div>
		@if ($errors->has('error_code') AND $errors->first('error_code') == 5)
			<script type="text/javascript">
				$('#addnewuser').modal('show');
			</script>
		@endif
	@endif
	@can('user_update')
		<div class="modal fade" tabindex="-1" role="dialog" id="editUser">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Edit account</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<form role="form" id="editUserForm" method="POST" action="{{ url('users/'.$user->username) }}">
									{!! method_field('PATCH') !!}
									{!! csrf_field() !!}
									<div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
										<label for="full_name">Full Name*</label>
										<input type="text" class="form-control" placeholder="Name Surname" name="full_name" value="{{ old('full_name') ? old('full_name') : '' }}" required>
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
											<input type="email" class="form-control" placeholder="user@email.com" name="email" value="{{ old('email') ? old('email') : '' }}" required>
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
											<input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
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
											<input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
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
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		</div>
			@if ($errors->has('error_code') AND $errors->first('error_code') == 6)
				<script type="text/javascript">
					$('#editUser').modal('show');
				</script>
			@endif
	@endif
	@can('user_delete')
		<div class="modal fade" tabindex="-1" role="dialog" id="confirmUserDelete">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Confirm user deletion</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure you want to delete <b><span id="username"></span></b>?</p>
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
	@can('role_update')
		<div class="modal fade" tabindex="-1" role="dialog" id="editUserRoles">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Edit roles</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<form role="form" id="updateUserRolesForm" method="POST" action="">
									{!! csrf_field() !!}
									<label for="roles">Roles</label><br />
										@foreach(crmRoles() as $role)
											<div class="form-group">
												<input type="checkbox" class="minimal margin-r-5" name="roles[{{ $role->id }}]" value="{{ $role->name }}" />&nbsp;&nbsp;{{ $role->label . ' (' . $role->name . ')' }}<br />
											</div>
										@endforeach
									<br style="clear:both;">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
		</div>
	@endcan
</section><!-- /.content -->
@stop
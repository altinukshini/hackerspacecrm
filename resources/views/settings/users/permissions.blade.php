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
			<h3 class="box-title">Permissions</h3>
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
									<td>{{ $permission->name }}</td>
									@foreach($roles as $role)
										<td class="text-center">
											<div class="form-group{{ $errors->has('enable_registration') ? ' has-error' : ' has-feedback' }}">
												<input type="checkbox" class="minimal" name="roles[{{ $role->id }}][{{ $permission->id }}]" value="{{ $permission->name }}" {{ $role->hasPermission($permission->id) ? 'checked' : '' }} />
											</div>
										</td>
									@endforeach
								</tr>
							@endforeach
						</tbody>
					</table>
					<br style="clear:both;">
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</div>
				</form>
			@endcan
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

@stop
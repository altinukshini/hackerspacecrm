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
			<h3 class="box-title">Menus</h3>
		</div>
		<div class="box-body">
			@can('menu_create')
				<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewmenu">
					<i class="fa fa-plus"></i> Add new
				</a>
			@endcan
			@can('menu_view')
				<!-- Supporting only 2 dimensions -->
				<div class="box-body">
					@foreach ($menus as $menugroup => $submenus)
						<br style="clear:both;">
						<h3><?php echo ucfirst($menugroup); ?> menus</h3>
						<table class="table table-responsive no-padding table-hover">
							<tbody>
								<tr>
									<th>icon</th>
									<th>slug</th>
									<th>Title</th>
									<th>URL</th>
									<th>parent</th>
									<th>permission</th>
									<th>group</th>
									<th>order</th>
									<th>description</th>
									@can('menu_update')
										<th>action</th>
									@endcan
								</tr>
								@foreach( $submenus as $menu )
									@if($menu->children->count())
										@if(empty($menu->parent_slug))
											<tr style="background-color:#ebebeb;">
												<td><i class="fa {{ $menu->icon }}"></i></td>
												<td>{{ $menu->slug }}</td>
												<td>{{ $menu->title }}</td>
												<td>{{ $menu->url }}</td>
												<td>{{ empty($menu->parent_slug) ? '' : $menu->parent_slug }}</td>
												<td>{{ $menu->permission->label }}</td>
												<td>{{ $menu->menu_group }}</td>
												<td>{{ $menu->menu_order }}</td>
												<td>{{ $menu->description }}</td>
												@can('menu_update')
													<td>
														<button type="button" title="Translate" class="btn btn-xs btn-default btn-flat" data-translatemenuurl="{{ url('settings/menus/'.$menu->id.'/translate') }}" data-toggle="modal" data-target="#translatemenu"><i class="fa fa-globe text-blue"></i></button>

														<button type="button" title="Edit" class="btn btn-xs btn-default btn-flat" onclick="editMenu('{{ url('settings/menus/'.$menu->id) }}')"><i class="fa fa-edit text-blue"></i></button>
														@can('menu_delete')
															<button type="button" title="Delete" data-menu_id="{{ $menu->id }}" data-menu_name="{{ $menu->title }}" data-deletemenuurl="{{ url('settings/menus/'.$menu->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmMenuDelete"><i class="fa fa-trash text-red"></i></button>
														@endcan
													</td>
												@endcan
											</tr>
											@foreach($menu->children as $child)
											<tr>
												<td><i class="fa {{ $child->icon }}"></i></td>
												<td>{{ $child->slug }}</td>
												<td>{{ $child->title }}</td>
												<td>{{ $child->url }}</td>
												<td>{{ empty($child->parent_slug) ? '' : $child->parent_slug }}</td>
												<td>{{ $child->permission->label }}</td>
												<td>{{ $child->menu_group }}</td>
												<td>{{ $child->menu_order }}</td>
												<td>{{ $child->description }}</td>
												@can('menu_update')
													<td>
														<button type="button" title="Translate" class="btn btn-xs btn-default btn-flat" data-translatemenuurl="{{ url('settings/menus/'.$child->id.'/translate') }}" data-toggle="modal" data-target="#translatemenu"><i class="fa fa-globe text-blue"></i></button>

														<button type="button" title="Edit"  class="btn btn-xs btn-default btn-flat" onclick="editMenu('{{ url('settings/menus/'.$child->id) }}')"><i class="fa fa-edit text-blue"></i></button>

														@can('menu_delete')
															<button type="button" title="Delete" data-menu_id="{{ $child->id }}" data-menu_name="{{ $child->title }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-deletemenuurl="{{ url('settings/menus/'.$child->id) }}" data-target="#confirmMenuDelete"><i class="fa fa-trash text-red"></i></button>
														@endcan
													</td>
												@endcan
											</tr>
											@endforeach
										@endif
									@else
										@if(empty($menu->parent_slug))
											<tr style="background-color:#ebebeb;">
												<td><i class="fa {{ $menu->icon }}"></i></td>
												<td>{{ $menu->slug }}</td>
												<td>{{ $menu->title }}</td>
												<td>{{ $menu->url }}</td>
												<td>{{ empty($menu->parent_slug) ? '' : $menu->parent_slug }}</td>
												<td>{{ $menu->permission->label }}</td>
												<td>{{ $menu->menu_group }}</td>
												<td>{{ $menu->menu_order }}</td>
												<td>{{ $menu->description }}</td>
												@can('menu_update')
													<td>
														<button type="button" title="Translate" class="btn btn-xs btn-default btn-flat" data-translatemenuurl="{{ url('settings/menus/'.$menu->id.'/translate') }}" data-toggle="modal" data-target="#translatemenu"><i class="fa fa-globe text-blue"></i></button>

														<button type="button" title="Edit" class="btn btn-xs btn-default btn-flat" onclick="editMenu('{{ url('settings/menus/'.$menu->id) }}')"><i class="fa fa-edit text-blue"></i></button>
														@can('menu_delete')
															<button type="button" title="Delete" data-menu_id="{{ $menu->id }}" data-menu_name="{{ $menu->title }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-deletemenuurl="{{ url('settings/menus/'.$menu->id) }}" data-target="#confirmMenuDelete"><i class="fa fa-trash text-red"></i></button>
														@endcan
													</td>
												@endcan
											</tr>
										@endif
									@endif
								@endforeach
							</tbody>
						</table>
					@endforeach
				</div>
			@endcan

		</div><!-- /.box-body -->
	</div><!-- /.box -->

	<div class="row">
		@can('menu_create')
			<div class="modal fade" tabindex="-1" role="dialog" id="addnewmenu">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Add new menu</h4>
						</div>
						<div class="modal-body">
							<form role="form" action="{{ url('/settings/menus') }}" METHOD="POST">
								{!! csrf_field() !!}
								<div class="row">
									<div class="col-md-4">
										<div class="form-group{{ $errors->has('icon') ? ' has-error' : ' has-feedback' }}">
											<label for="icon">Font awesome icon*</label>
											<div class="input-group">
												<input name="icon" class="form-control icp icp-auto iconpicker-input iconpicker-element" value="fa-circle-o" type="text" required>
												<span class="input-group-addon"></span>
											</div>
											@if ($errors->has('icon'))
											<span class="help-block">
												<strong>{{ $errors->first('icon') }}</strong>
											</span>
											@endif
										</div>
										<br>
										<input type="hidden" class="form-control" name="locale" value="{{ getCurrentSessionAppLocale() }}" required/>
										<div class="form-group{{ $errors->has('slug') ? ' has-error' : ' has-feedback' }}">
											<label for="slug">Slug*</label>
											<input type="text" class="form-control" name="slug" value="{{ old('slug') }}" required/>
											<p>Exc: users, reports, expenses (all lowercase)</p>
											@if ($errors->has('slug'))
											<span class="help-block">
												<strong>{{ $errors->first('slug') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group{{ $errors->has('parent_slug') ? ' has-error' : ' has-feedback' }}">
											<label for="parent_slug">Parent slug</label>
											<input type="text" class="form-control" name="parent_slug" value="{{ old('parent_slug') }}">
											<p>Leave empty for master menu, or add the slug of a parent menu to add this menu as child.</p>
											@if ($errors->has('parent_slug'))
											<span class="help-block">
												<strong>{{ $errors->first('parent_slug') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group{{ $errors->has('menu_order') ? ' has-error' : ' has-feedback' }}">
											<label for="menu_order">Order*</label>
											<input type="number" class="form-control" placeholder="0" min="0" name="menu_order" value="{{ old('menu_order') ? old('menu_order') : 0 }}" required>
											<p>0 highest</p>
											@if ($errors->has('menu_order'))
											<span class="help-block">
												<strong>{{ $errors->first('menu_order') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group{{ $errors->has('title') ? ' has-error' : ' has-feedback' }}">
													<label for="title">Name*</label>
													<input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') }}" required>
													@if ($errors->has('title'))
													<span class="help-block">
														<strong>{{ $errors->first('title') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('url') ? ' has-error' : ' has-feedback' }}">
													<label for="url">URL</label>
													<input type="text" class="form-control" placeholder="hello/world" name="url" value="{{ old('url') }}">
													@if ($errors->has('url'))
													<span class="help-block">
														<strong>{{ $errors->first('url') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
													<label for="description">Description</label>
													<input type="text" class="form-control" placeholder="This is just a description" name="description" value="{{ old('description') }}">

													@if ($errors->has('description'))
													<span class="help-block">
														<strong>{{ $errors->first('description') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group{{ $errors->has('permission_id') ? ' has-error' : ' has-feedback' }}">
													<label for="permission_id">Permission*</label>
													<select class="form-control" name="permission_id" required>
														<option disabled selected>Select permission</option>
														@foreach (crmPermissions() as $permission)
															<option value="{{ $permission->id }}" {{ old('permission_id') == $permission->id ? "selected" : "" }}>{{ $permission->name . ' - ' .$permission->label }}</option>
														@endforeach
													</select>
													<p>Permission which can access this menu. <br />Select "public" for non aithenticated users to see it.</p>
													@if ($errors->has('permission_id'))
													<span class="help-block">
														<strong>{{ $errors->first('permission_id') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group{{ $errors->has('menu_group') ? ' has-error' : ' has-feedback' }}">
													<label for="menu_group">Group*</label>
													<select class="form-control" name="menu_group" required>
														<option disabled selected>Select group</option>
														@foreach (crminfo('menu_groups') as $menugroup)
															<option value="{{ $menugroup }}" {{ old('menu_group') == $menugroup ? "selected" : "" }}>{{ ucfirst($menugroup) }}</option>
														@endforeach
													</select>
													@if ($errors->has('menu_group'))
													<span class="help-block">
														<strong>{{ $errors->first('menu_group') }}</strong>
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
			</div>
			<!-- If edit menu request has error, open editmenu modal -->
			@if ($errors->has('error_code') AND $errors->first('error_code') == 5)
			<script type="text/javascript">
				$('#addnewmenu').modal('show');
			</script>
			@endif
		@endcan
		@can('menu_update')
			<div class="modal fade" tabindex="-1" role="dialog" id="editmenu">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Edit menu</h4>
						</div>
						<div class="modal-body">
							<form role="form" id="editMenuForm" method="POST" action="">
								{!! method_field('PATCH') !!}
								{!! csrf_field() !!}
								<div class="row">
									<div class="col-md-4">
										<div class="form-group{{ $errors->has('icon') ? ' has-error' : ' has-feedback' }}">
											<label for="icon">Font awesome icon*</label>
											<div class="input-group">
												<input name="icon" class="form-control icp icp-auto iconpicker-input iconpicker-element" value="fa-circle-o" type="text" required>
												<span class="input-group-addon"></span>
											</div>
											@if ($errors->has('icon'))
											<span class="help-block">
												<strong>{{ $errors->first('icon') }}</strong>
											</span>
											@endif
										</div>
										<br>
										<div class="form-group{{ $errors->has('parent_slug') ? ' has-error' : ' has-feedback' }}">
											<label for="parent_slug">Parent slug</label>
											<input type="text" class="form-control" name="parent_slug" min="0" value="{{ old('parent_slug') }}">
											<p>Leave empty for master menu, or add the slug of a parent menu to add this menu as child.</p>
											@if ($errors->has('parent_slug'))
											<span class="help-block">
												<strong>{{ $errors->first('parent_slug') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group{{ $errors->has('menu_order') ? ' has-error' : ' has-feedback' }}">
											<label for="menu_order">Order*</label>
											<input type="number" class="form-control" placeholder="0" min="0" name="menu_order" value="{{ old('menu_order') }}" required>
											<p>0 highest</p>
											@if ($errors->has('menu_order'))
											<span class="help-block">
												<strong>{{ $errors->first('menu_order') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group{{ $errors->has('title') ? ' has-error' : ' has-feedback' }}">
													<label for="title">Name*</label>
													<input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') }}" required>
													@if ($errors->has('title'))
													<span class="help-block">
														<strong>{{ $errors->first('title') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('url') ? ' has-error' : ' has-feedback' }}">
													<label for="url">URL</label>
													<input type="text" class="form-control" placeholder="hello/world" name="url" value="{{ old('url') }}">
													@if ($errors->has('url'))
													<span class="help-block">
														<strong>{{ $errors->first('url') }}</strong>
													</span>
													@endif
												</div>
												<div class="form-group{{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
													<label for="description">Description</label>
													<input type="text" class="form-control" placeholder="This is just a description" name="description" value="{{ old('description') }}">

													@if ($errors->has('description'))
													<span class="help-block">
														<strong>{{ $errors->first('description') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group{{ $errors->has('permission_id') ? ' has-error' : ' has-feedback' }}">
													<label for="permission_id">Permission*</label>
													<select class="form-control" name="permission_id" required>
														<option disabled selected>Select permission</option>
														@foreach (crmPermissions() as $permission)
															<option value="{{ $permission->id }}" {{ old('permission_id') == $permission->id ? "selected" : "" }}>{{ $permission->name . ' - ' .$permission->label }}</option>
														@endforeach
													</select>
													<p>Permission which can access this menu. <br />Select "public" for non aithenticated users to see it.</p>
													@if ($errors->has('permission_id'))
													<span class="help-block">
														<strong>{{ $errors->first('permission_id') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group{{ $errors->has('menu_group') ? ' has-error' : ' has-feedback' }}">
													<label for="menu_group">Group*</label>
													<select class="form-control" name="menu_group" required>
														<!-- <option disabled selected>Select group</option> -->
														@foreach (crminfo('menu_groups') as $menugroup)
															<option value="{{ $menugroup }}" {{ Request::old('menu_group') == $menugroup ? "selected" : "" }}>{{ ucfirst($menugroup) }}</option>
														@endforeach
													</select>

													@if ($errors->has('menu_group'))
													<span class="help-block">
														<strong>{{ $errors->first('menu_group') }}</strong>
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
			</div>
			<!-- If edit menu request has error, open editmenu modal -->
			@if ($errors->has('error_code') AND $errors->first('error_code') == 6)
			<script type="text/javascript">
				$('#editmenu').modal('show');
			</script>
			@endif
		@endcan
		@can('menu_update')
			<div class="modal fade" tabindex="-1" role="dialog" id="translatemenu">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Create translation</h4>
						</div>
						<div class="modal-body">
							<form role="form" id="translateMenuForm" method="POST" action="">
								{!! csrf_field() !!}
								<div class="row">
									<div class="col-md-12">
										<div class="form-group {{ $errors->has('locale') ? ' has-error' : ' has-feedback' }}">
										    <label for="locale">Select locale</label>
										    <select class="form-control" name="locale" required>
										        <option disabled selected>Select locale</option>
										        @foreach (getAvailableAppLocaleArray() as $localekey => $localevalue)
										            @if($localekey != getCurrentSessionAppLocale())
										                <option value="{{ $localekey }}" {{ old('locale') == $localekey ? "selected" : "" }}>{{ $localekey . ' - ' .$localevalue }}</option>
										            @endif
										        @endforeach
										    </select>

										    @if ($errors->has('locale'))
										    <span class="help-block">
										        <strong>{{ $errors->first('locale') }}</strong>
										    </span>
										    @endif
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
			</div>
			<!-- If edit menu request has error, open editmenu modal -->
			@if ($errors->has('error_code') AND $errors->first('error_code') == 7)
			<script type="text/javascript">
				$('#translatemenu').modal('show');
			</script>
			@endif
		@endcan	
		@can('menu_delete')
			<div class="modal fade" tabindex="-1" role="dialog" id="confirmMenuDelete">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<h4 class="modal-title">Confirm menu deletion</h4>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete <b><span id="mName"></span></b>?</p>
								<p><b>Note: </b>All children of this menu will not be deleted but will become parents.</p>
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
	</div>
</section><!-- /.content -->





@stop

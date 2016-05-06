@extends('layouts.app')

@section('scripts')
<script type="text/javascript">
	// triggered when modal is about to be shown
	$('#confirmDelete').on('show.bs.modal', function(e) {
		//get data-id attribute of the clicked element
		var menuId = 'hej';
		console.log('hej');
		var menuName = $(e.relatedTarget).data('menu_name');
		$("#confirmDelete #mName").val( menuName );
		$("#delForm").attr('action', 'put your action here with menuId');//e.g. 'domainname/products/' + menuId
	});
</script>
@stop

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
			<a class="btn btn-success btn-md" data-toggle="modal" data-target="#addnewmenu">
				<i class="fa fa-plus"></i> Add new
			</a>

			@foreach ($menus as $menugroup => $submenus)
			<div class="box-body table-responsive no-padding">
				<br style="clear:both;">
				<h3><?php echo ucfirst($menugroup); ?> menus</h3>
				<table class="table table-hover">
					<tbody>
						<tr>
							<th>ID</th>
							<th>icon</th>
							<th>Title</th>
							<th>URL</th>
							<th>parent id</th>
							<th>permission</th>
							<th>group</th>
							<th>order</th>
							<th>description</th>
							<th>action</th>
						</tr>
						@foreach( $submenus as $menu )
							@if($menu->children->count())
								@if($menu->parent_id == 0)
									<tr style="background-color:#ebebeb;">
										<td>{{ $menu->id }}</td>
										<td><i class="fa {{ $menu->icon }}"></i></td>
										<td>{{ $menu->title }}</td>
										<td>{{ $menu->url }}</td>
										<td>{{ $menu->parent_id }}</td>
										<td>{{ $menu->permission }}</td>
										<td>{{ $menu->menu_group }}</td>
										<td>{{ $menu->menu_order }}</td>
										<td>{{ $menu->description }}</td>
										<td>
											<button type="button" class="btn btn-xs btn-default btn-flat" onclick="editMenu({{ $menu->id }})"><i class="fa fa-edit text-blue"></i></button>

											<button type="button" data-menu_id="{{ $menu->id }}" data-menu_name="{{ $menu->title }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash text-red"></i></button>
										</td>
									</tr>
									@foreach($menu->children as $child)
									<tr>
										<td>{{ $child->id }}</td>
										<td><i class="fa {{ $child->icon }}"></i></td>
										<td>{{ $child->title }}</td>
										<td>{{ $child->url }}</td>
										<td>{{ $child->parent_id }}</td>
										<td>{{ $child->permission }}</td>
										<td>{{ $child->menu_group }}</td>
										<td>{{ $child->menu_order }}</td>
										<td>{{ $child->description }}</td>
										<td>
											<button type="button" class="btn btn-xs btn-default btn-flat" onclick="editMenu({{ $child->id }})"><i class="fa fa-edit text-blue"></i></button>

											<button type="button" data-menu_id="{{ $child->id }}" data-menu_name="{{ $child->title }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash text-red"></i></button>
										</td>
									</tr>
									@endforeach
								@endif
							@else
								@if($menu->parent_id == 0)
									<tr style="background-color:#ebebeb;">
										<td>{{ $menu->id }}</td>
										<td><i class="fa {{ $menu->icon }}"></i></td>
										<td>{{ $menu->title }}</td>
										<td>{{ $menu->url }}</td>
										<td>{{ $menu->parent_id }}</td>
										<td>{{ $menu->permission }}</td>
										<td>{{ $menu->menu_group }}</td>
										<td>{{ $menu->menu_order }}</td>
										<td>{{ $menu->description }}</td>
										<td>
											<button type="button" class="btn btn-xs btn-default btn-flat" onclick="editMenu({{ $menu->id }})"><i class="fa fa-edit text-blue"></i></button>

											<button type="button" data-menu_id="{{ $menu->id }}" data-menu_name="{{ $menu->title }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash text-red"></i></button>
										</td>
									</tr>
								@endif
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
			@endforeach

		</div><!-- /.box-body -->
	</div><!-- /.box -->

	<div class="row">
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
						<form role="form" action='/settings/menus' METHOD='POST'>
							{!! csrf_field() !!}
							<div class="row">
								<div class="col-md-4">
									<div class="form-group{{ $errors->has('icon') ? ' has-error' : ' has-feedback' }}">
										<label for="icon">Font awesome icon</label>
										<input name="icon" class="form-control icp icp-auto" value="fa-circle-o" type="text">
										<span class="input-group-addon"></span>

										@if ($errors->has('icon'))
										<span class="help-block">
											<strong>{{ $errors->first('icon') }}</strong>
										</span>
										@endif
									</div>
									<br>
									<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : ' has-feedback' }}">
										<label for="parent_id">Parent ID</label>
										<input type="number" class="form-control" placeholder="0" name="parent_id" value="{{ old('parent_id') }}">
										<p>Leave 0 for master menu, or add the ID of a parent menu to add this menu as child.</p>
										@if ($errors->has('parent_id'))
										<span class="help-block">
											<strong>{{ $errors->first('parent_id') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('menu_order') ? ' has-error' : ' has-feedback' }}">
										<label for="menu_order">Order</label>
										<input type="number" class="form-control" placeholder="0" name="menu_order" value="{{ old('menu_order') }}">
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
												<label for="title">Name</label>
												<input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') }}">
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
										<div class="col-md-6">
											<div class="form-group{{ $errors->has('permission') ? ' has-error' : ' has-feedback' }}">
												<label for="permission">Permission</label>
												<input type="text" class="form-control" placeholder="member" name="permission" value="{{ old('permission') }}">
												<p>User role which can access this menu. Exc: member, administrator etc. 
												<br />Leave empty or type "public" for non aithenticated users to see it.</p>
												@if ($errors->has('permission'))
												<span class="help-block">
													<strong>{{ $errors->first('permission') }}</strong>
												</span>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group{{ $errors->has('menu_group') ? ' has-error' : ' has-feedback' }}">
												<label for="menu_group">Group</label>
												<select class="form-control" name="menu_group">
													@foreach (crminfo('menu_groups') as $menugroup)
														<option value="{{ $menugroup }}" {{ Request::old('menu_group') == $menugroup ? "selected" : "" }}>{{ $menugroup }}</option>
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
										<label for="icon">Font awesome icon</label>
										<input name="icon" class="form-control icp icp-auto" value="fa-circle-o" type="text">
										<span class="input-group-addon"></span>
										@if ($errors->has('icon'))
										<span class="help-block">
											<strong>{{ $errors->first('icon') }}</strong>
										</span>
										@endif
									</div>
									<br>
									<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : ' has-feedback' }}">
										<label for="parent_id">Parent ID</label>
										<input type="number" class="form-control" placeholder="0" name="parent_id" value="{{ old('parent_id') }}">
										<p>Leave 0 for master menu, or add the ID of a parent menu to add this menu as child.</p>
										@if ($errors->has('parent_id'))
										<span class="help-block">
											<strong>{{ $errors->first('parent_id') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('menu_order') ? ' has-error' : ' has-feedback' }}">
										<label for="menu_order">Order</label>
										<input type="number" class="form-control" placeholder="0" name="menu_order" value="{{ old('menu_order') }}">
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
												<label for="title">Name</label>
												<input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') }}">
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
										<div class="col-md-6">
											<div class="form-group{{ $errors->has('permission') ? ' has-error' : ' has-feedback' }}">
												<label for="permission">Permission</label>
												<input type="text" class="form-control" placeholder="member" name="permission" value="{{ old('permission') }}">
												<p>User role which can access this menu. Exc: member, administrator etc. 
												<br />Type "public" for non aithenticated users to see it.</p>
												@if ($errors->has('permission'))
												<span class="help-block">
													<strong>{{ $errors->first('permission') }}</strong>
												</span>
												@endif
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group{{ $errors->has('menu_group') ? ' has-error' : ' has-feedback' }}">
												<label for="menu_group">Group</label>
												<select class="form-control" name="menu_group">
													@foreach (crminfo('menu_groups') as $menugroup)
														<option value="{{ $menugroup }}" {{ Request::old('menu_group') == $menugroup ? "selected" : "" }}>{{ $menugroup }}</option>
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
		<div class="modal fade" tabindex="-1" role="dialog" id="confirmDelete">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<h4 class="modal-title">Confirm Menu Deletion</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure you want to delete <b><span id="mName"></span></b>?</p>
							<p><b>Note: </b>Menu children will become parents.</p>
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
	</div>

</section><!-- /.content -->

<!-- If edit menu request has error, open editmenu modal -->
@if ($errors->has('error_code') AND $errors->first('error_code') == 5)
<script type="text/javascript">
	$('#addnewmenu').modal('show');
</script>
@endif

<!-- If edit menu request has error, open editmenu modal -->
@if ($errors->has('error_code') AND $errors->first('error_code') == 6)
<script type="text/javascript">
	$('#editmenu').modal('show');
</script>
@endif

<script type="text/javascript">

	function editMenu(id) {
        $('#editMenuForm')[0].reset();
        $.ajax({
            url: "/settings/menus/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#editMenuForm').attr('action', '/settings/menus/'+id);
                $('#editMenuForm .input-group-addon').html('<i class="fa '+ data.icon +'"></i>');
                $('#editMenuForm [name="icon"]').val(data.icon);
                $('#editMenuForm [name="parent_id"]').val(data.parent_id);
                $('#editMenuForm [name="menu_order"]').val(data.menu_order);
                $('#editMenuForm [name="title"]').val(data.title);
                $('#editMenuForm [name="url"]').val(data.url);
                $('#editMenuForm [name="description"]').val(data.description);
                $('#editMenuForm [name="permission"]').val(data.permission);
                $('#editMenuForm [name="menu_group"]').val(data.menu_group);

                // Open modal for edit:
                $('#editmenu').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error getting data!');
            }
        });
    }

	// triggered when modal is about to be shown
	$('#confirmDelete').on('show.bs.modal', function(e) {
		//get data-id attribute of the clicked element
		menuId = $(e.relatedTarget).data('menu_id');
		menuName = $(e.relatedTarget).data('menu_name');
		$("#confirmDelete #mName").html( menuName );
		$("#delForm").attr('action', '/settings/menus/' + menuId);//e.g. 'domainname/products/' + menuId
	});

	$('.action-destroy').on('click', function() {
		$.iconpicker.batch('.icp.iconpicker-element', 'destroy');
	});
	$('.icp-auto').iconpicker();
		// Live binding of buttons
	$(document).on('click', '.action-placement', function(e) {
		$('.action-placement').removeClass('active');
		$(this).addClass('active');
		$('.icp-opts').data('iconpicker').updatePlacement($(this).text());
		e.preventDefault();
		return false;
	});

	// Events sample:
	// This event is only triggered when the actual input value is changed
	// by user interaction
	$('.icp').on('iconpickerSelected', function(e) {
		$('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
		e.iconpickerInstance.options.iconBaseClass + ' ' +
		e.iconpickerInstance.getValue(e.iconpickerValue);
	});
</script>
@stop

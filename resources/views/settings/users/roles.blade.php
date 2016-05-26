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
					<table class="table table-responsive no-padding table-hover">
						<tbody>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Label</th>
							</tr>
							@foreach($roles as $role)
								<tr>
									<td>{{ $role->id }}</td>
									<td>{{ $role->name }}</td>
									<td>{{ $role->label }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section><!-- /.content -->

@stop
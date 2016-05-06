@if (session()->has('status'))
<div class="content-header">
	<div class="alert alert-{{ session('status-type') }} {{ session('status-dismissable') ? 'alert-dismissible alert-fade' : '' }}">
		@if (session('status-dismissable'))
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		@endif
		{{ session('status') }}
	</div>
</div>
@endif
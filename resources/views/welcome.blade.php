@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<h2>{{ trans('hackerspacecrm.messages.welcome', ['applicationname' => crminfo('name')]) }}</h2>
		</div>
		<!-- Example -->
		<div class="col-md-12">
		</div>
	</div>
</section>

@endsection

@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
	    <div class="col-md-12">
	        <h2>{{ trans('hackerspacecrm.messages.welcome', ['applicationname' => 'Hackerspace CRM']) }}</h2>
	    </div>
	    <!-- Example -->
	    <div class="col-md-12">
	        @can('edit_cms')
				Can edit member.
	        @endcan
	    </div>
	</div>
</section>

@endsection

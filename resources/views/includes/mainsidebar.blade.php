<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		@if (Auth::user())
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				@if (Auth::user()->hasProfile())
					<a href="{{ Auth::user()->profilePath() }}"><img src="{{ get_gravatar(Auth::user()->email, 160) }}" class="" alt="User Image"></a>
				@else
					<a href="{{ url('users/'.Auth::user()->username.'/edit') }}"><img src="{{ get_gravatar(Auth::user()->email, 160) }}" class="" alt="User Image"></a>
				@endif
			</div>
			<div class="pull-left info">
				@if (Auth::user()->hasProfile())
					<p><a href="{{ Auth::user()->profilePath() }}">{{ Auth::user()->full_name }}</a></p>
				@else
					<p><a href="{{ url('users/'.Auth::user()->username.'/edit') }}">{{ Auth::user()->full_name }}</a></p>
				@endif
				
				<a href="#"><i class="fa fa-circle text-success"></i> In Space</a>
			</div>
		</div>
		@endif

		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			@include('includes.mainnavigation')
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
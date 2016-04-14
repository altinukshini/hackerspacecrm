<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
	@if (Auth::user())
		<!-- Sidebar user panel -->
	  <div class="user-panel">
		<div class="pull-left image">
		  <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info">
		  <p>{{ Auth::user()->full_name }}</p>
		  <a href="#"><i class="fa fa-circle text-success"></i> In Space</a>
		</div>
	  </div>
	@endif

	<!-- /.search form -->
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
	  <li class="header">MAIN NAVIGATION</li>
	  <li>
		<a href="{{ url('/') }}">
		  <i class="fa fa-dashboard"></i> <span>/</span>
		</a>
	  </li>
	  <li>
		<a href="{{ url('/home') }}">
		  <i class="fa fa-dashboard"></i> <span>Home</span>
		</a>
	  </li>
	</ul>
  </section>
  <!-- /.sidebar -->
</aside>
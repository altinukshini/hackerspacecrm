	<header class="main-header">
		<!-- Logo -->
		<a href="{{ url('/') }}" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini">CRM</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>Hackerspace</b> CRM</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<!-- Application locale switcher -->
					<li class="dropdown messages-menu pull-left">
						<a href="#" class="dropdown-toggle pull-left" data-toggle="dropdown">
							{{ getCurrentSessionAppLocale() }}
						</a>
						<ul class="dropdown-menu">
							@foreach (getAvailableAppLocaleArray() as $lang => $language)
							@if ($lang != getCurrentSessionAppLocale())
							<li>
								<a href="{{ route('locale.switch', $lang) }}">{{$language}}</a>
							</li>
							@endif
							@endforeach
						</ul>
					</li>

					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
						
						<!-- Authentication Links -->
						@if (Auth::guest())
						<li><a href="{{ url('/login') }}">Login</a></li>
						<li><a href="{{ url('/register') }}">Register</a></li>
						@else
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
							<span class="hidden-xs">{{ Auth::user()->full_name }}</span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header">
								<img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
								<p>
									{{ Auth::user()->full_name }}
									<small>Member since Nov. 2012</small>
								</p>
							</li>
							
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="{{ Auth::user()->profilePath() }}" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
						@endif
					</li>
					@if (hasRole('administrator'))
					<!-- Control Sidebar Toggle Button -->
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
					@endif
				</ul>
			</div>
		</nav>
	</header>
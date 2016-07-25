	<header class="main-header">
		<!-- Logo -->
		<a href="{{ url('/') }}" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini">CRM</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg">{{ crminfo('name') }}</span>
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
					@if(isCRMMultilingual())
						<li class="dropdown messages-menu locale-dropdown pull-left">
							<a href="#" class="dropdown-toggle pull-left" data-toggle="dropdown">
                                <i class="fa fa-flag"></i>&nbsp;{{ getAvailableAppLocaleArray()[getCurrentSessionAppLocale()] }}&nbsp;<i class="caret"></i>
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
					@endif

					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
						
						<!-- Authentication Links -->
						@if (Auth::guest())
						<li><a href="{{ url('/login') }}">{{ trans('hackerspacecrm.forms.labels.login') }}</a></li>
						@if(crminfo('enable_registration') == 1)
						<li><a href="{{ url('/register') }}">{{ trans('hackerspacecrm.forms.labels.register') }}</a></li>
						@endif
						@else
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="{{ get_gravatar(Auth::user()->email, 160) }}" class="user-image" alt="User Image">
							<span class="hidden-xs">{{ Auth::user()->full_name }}</span> <i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header">
								<img src="{{ get_gravatar(Auth::user()->email, 160) }}" class="" alt="User Image">
								<p>
									{{ Auth::user()->full_name }}
									<small>Member since Nov. 2012</small>
								</p>
							</li>
							
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									@if (!Auth::user()->hasProfile() AND Auth::user()->hasRole(['member', 'administrator']))
										<a href="{{ url('users/'.Auth::user()->username.'/edit') }}" class="btn btn-default btn-flat">{{ trans('hackerspacecrm.forms.labels.editaccount') }}</a><br /><br />
										<a href="{{ url('profiles/'. Auth::user()->username .'/create') }}" class="btn btn-success btn-flat">{{ trans('hackerspacecrm.forms.labels.createprofile') }}</a>
									@elseif (Auth::user()->hasProfile())
										<a href="{{ url(Auth::user()->profilePath()) }}" class="btn btn-default btn-flat">{{ trans('hackerspacecrm.forms.labels.profile') }}</a>
									@else
										<a href="{{ url('users/'.Auth::user()->username.'/edit') }}" class="btn btn-default btn-flat">Edit Account</a>
									@endif
								</div>
								<div class="pull-right">
									<a href="{{ url('/logout') }}" class="btn btn-default btn-flat"><i class="fa fa-power-off text-red"></i> {{ trans('hackerspacecrm.forms.labels.logout') }}</a>
								</div>
							</li>
						</ul>
						@endif
					</li>
					@can('setting_view')
						<!-- Control Sidebar Toggle Button -->
						<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
					@endcan
				</ul>
			</div>
		</nav>
	</header>
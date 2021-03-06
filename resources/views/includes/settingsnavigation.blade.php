@can('setting_view')
	<li class="header"><i class="fa fa-sliders" style="margin-right:5px;"></i> {{ trans('hackerspacecrm.menus.settings') }}</li>
	@if(count($settings))
		@foreach( $settings as $menu )
			@if($menu->children->count())
				@if($menu->parent_slug == '' and hasPermission($menu->permission_id))
					<li class="treeview {{ setMenuActive($menu->url) }}">
						<a href="{{$menu->url}}">
							<i class="fa {{$menu->icon}}"></i>
							<span>{{$menu->title}}</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							@foreach($menu->children as $child)
								@if(hasPermission($child->permission_id))
									<li class="{{ setMenuActive($child->url) }}"><a href="{{ url('/'.$child->url) }}"><i class="fa {{$child->icon}}"></i> {{$child->title}}</a></li>
								@endif
							@endforeach
						</ul>
					</li>
				@endif
			@else
				@if($menu->parent_slug == '' and hasPermission($menu->permission_id))
				<li class="{{ setMenuActive($menu->url) }}">
					<a href="{{ url('/'.$menu->url) }}">
						<i class="fa {{$menu->icon}}"></i> <span>{{$menu->title}}</span>
					</a>
				</li>
				@endif
			@endif
		@endforeach
	@endif
@endcan
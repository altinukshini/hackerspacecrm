<li class="header"><i class="fa fa-bars" style="margin-right:5px;"></i> {{ trans('hackerspacecrm.menus.mainnavigation') }}</li>
@can('menu_view')
@foreach( $menus as $menu )
	@cache($menu)
	@if($menu->children->count())
		@if($menu->parent_id == 0 and hasPermission($menu->permission))
			<li class="treeview {{ setMenuActive($menu->url) }}">
				<a href="{{$menu->url}}">
					<i class="fa {{$menu->icon}}"></i>
					<span>{{$menu->title}}</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					@foreach($menu->children as $child)
						@cache($child)
						@if(hasPermission($child->permission))
							<li><a href="{{ url('/'.$child->url) }}"><i class="fa {{$child->icon}}"></i> {{$child->title}}</a></li>
						@endif
						@endcache
					@endforeach
				</ul>
			</li>
		@endif
	@else
		@if($menu->parent_id == 0 and hasPermission($menu->permission))
		<li class="{{ setMenuActive($menu->url) }}">
			<a href="{{ url('/'.$menu->url) }}">
				<i class="fa {{$menu->icon}}"></i> <span>{{$menu->title}}</span>
			</a>
		</li>
		@endif
	@endif
	@endcache
@endforeach
@endcan
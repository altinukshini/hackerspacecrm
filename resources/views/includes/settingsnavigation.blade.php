@can('view_settings')
<li class="header"><i class="fa fa-sliders" style="margin-right:5px;"></i> {{ trans('hackerspacecrm.menus.settings') }}</li>
@foreach( $menus as $menu )
	@if($menu->children->count())
		@if($menu->parent_id == 0)
			<li class="treeview {{ setMenuActive($menu->url) }}">
				<a href="{{$menu->url}}">
					<i class="fa {{$menu->icon}}"></i>
					<span>{{$menu->title}}</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					@foreach($menu->children as $child)
						<li><a href="{{ url('/'.$child->url) }}"><i class="fa {{$child->icon}}"></i> {{$child->title}}</a></li>
					@endforeach
				</ul>
			</li>
		@endif
	@else
		@if($menu->parent_id == 0)
		  <li class="{{ setMenuActive($menu->url) }}">
			  <a href="{{ url('/'.$menu->url) }}">
				<i class="fa {{$menu->icon}}"></i> <span>{{$menu->title}}</span>
			  </a>
		  </li>
		@endif
	@endif
@endforeach
@endcan
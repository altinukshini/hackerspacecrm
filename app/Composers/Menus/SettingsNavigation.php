<?php

namespace App\Composers\Menus;

use App\Models\Menu;
use Illuminate\Contracts\View\View;

class SettingsNavigation
{
	protected $menu;

	public function __construct(Menu $menu)
	{
		$this->menu = $menu;
	}

	public function compose(View $view)
	{
		$menus = $this->menu->with('children')->where('menu_group', 'settings')
		->where('parent_id', '0')
		->orderBy('menu_order', 'asc')
		->get();

		$view->with('menus', $menus);
	}
}
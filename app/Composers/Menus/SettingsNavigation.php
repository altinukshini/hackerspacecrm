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
		$view->with('menus', $this->menu->where('menu_group', 'settings')->orderBy('menu_order', 'asc')->get());
	}
}
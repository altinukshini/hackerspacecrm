<?php

namespace App\Composers\Menus;

use App\Models\Menu;
use Illuminate\Contracts\View\View;

class MainNavigation
{
	protected $menu;

	public function __construct(Menu $menu)
	{
		$this->menu = $menu;
	}

	public function compose(View $view)
	{
		$view->with('menus', $this->menu->where('menu_group', 'mainnavigation')->get());
	}
}
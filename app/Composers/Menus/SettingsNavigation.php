<?php

namespace App\Composers\Menus;

use Cache;
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
		$settings = Cache::remember('smenus_settings', 24*60, function() {
            return $this->menu->with('children')->where('menu_group', 'settings')
                    ->where('parent_id', '0')
                    ->orderBy('menu_order', 'asc')
                    ->get();
        });

		$view->with('settings', $settings);
	}
}
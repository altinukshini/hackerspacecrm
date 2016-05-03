<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Menu;

class SettingsController extends Controller
{
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');

        $this->menu = $menu;
    }

    // 
    // CLEAN THIS UP!!!
    // 
    public function showMenu()
    {
        $menu = $this->menu;
        $public = Cache::remember('menus_public', 24*60, function() use ($menu) {
            return $menu->with('children')->where('menu_group', 'public')
                    ->where('parent_id', '0')
                    ->orderBy('menu_order', 'asc')
                    ->get();
        });

        $main = Cache::remember('menus_main', 24*60, function() use ($menu) {
            return $menu->with('children')->where('menu_group', 'main')
                    ->where('parent_id', '0')
                    ->orderBy('menu_order', 'asc')
                    ->get();
        });

        $settings = Cache::remember('menus_settings', 24*60, function() use ($menu) {
            return $menu->with('children')->where('menu_group', 'settings')
                    ->where('parent_id', '0')
                    ->orderBy('menu_order', 'asc')
                    ->get();
        });

        return view('settings.menus')->with('main', $main)
        ->with('settings', $settings)
        ->with('public', $public);
    }

    public function updateMenu(Request $request, $id)
    {
    }
}

<?php

namespace App\Http\Controllers;

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

    public function showMenu()
    {
        $mainnavigation = $this->menu->where('menu_group', 'mainnavigation')
        ->orderBy('menu_order', 'asc')
        ->get();
        $settings = $this->menu->where('menu_group', 'settings')
        ->orderBy('menu_order', 'asc')
        ->get();

        return view('settings.menus')->with('mainnavigation', $mainnavigation)
        ->with('settings', $settings);
    }

    public function updateMenu(Request $request, $id)
    {
    }
}

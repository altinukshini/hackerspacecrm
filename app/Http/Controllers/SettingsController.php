<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use HackerspaceCRM\Menu\Menu;

class SettingsController extends Controller
{
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');

        $this->menu = $menu;
    }

    public function updateMenu(Request $request, $id)
    {
    }

    public function addMenu(Request $request)
    {
        $menu = new Menu();
        $menu->icon = $request->icon;
        $menu->parent_id = $request->parent_id;
        $menu->menu_order = $request->menu_order;
        $menu->url = $request->url;
        $menu->menu_group = $request->menu_group;
        $menu->description = $request->description;
        $menu->permission = $request->permission;
        $menu->title = $request->title;

        $this->validate($request, [
              'title' => 'required|max:100',
              'url' => 'required',
              'permission' => 'required',
              'menu_group' => 'required',
            ]);
        $menu->parent()->save();
    }
}

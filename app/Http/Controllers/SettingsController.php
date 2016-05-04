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
        
        $public = Cache::remember('menu_public', 24*60, function(){
            return $this->menu->with('children')->where('menu_group', 'public')
                    ->where('parent_id', '0')
                    ->orderBy('menu_order', 'asc')
                    ->get();
        });

        $main = Cache::remember('menu_main', 24*60, function(){
            return $this->menu->with('children')->where('menu_group', 'main')
                    ->where('parent_id', '0')
                    ->orderBy('menu_order', 'asc')
                    ->get();
        });

        $settings = Cache::remember('menu_settings', 24*60, function(){
            return $this->menu->with('children')->where('menu_group', 'settings')
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

    public function addMenu(Request $request){
            $menu = new Menu;
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

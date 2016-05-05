<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Requests;
use Cache;



class MenusController extends Controller
{

  protected $menu;

  public function __construct(Menu $menu)
  {
    $this->menu = $menu;
  }


  public function show()
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



  public function add(Request $request){
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
            'parent_id' => 'required',
            'menu_order' => 'required',

          ]);
          $menu->save();

          return redirect('/settings/menus/');

  }
  public function delete($id){

      $menu = Menu::find($id);
      $menu->delete();
      return back();

  }
  public function update($id){

      $menu = Menu::find($id);
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
        'url' => 'required|max:100',
        'permission' => 'required',
        'menu_group' => 'required',
        'parent_id' => 'required',
        'menu_order' => 'required',
      ]);
      $menu->save();

  }
}

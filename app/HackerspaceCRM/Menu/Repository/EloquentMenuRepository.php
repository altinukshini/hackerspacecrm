<?php

namespace HackerspaceCRM\Menu\Repository;

use Flash;
use HackerspaceCRM\Menu\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentMenuRepository implements MenuRepositoryInterface
{
    public function getAll()
    {
        return Menu::all();
    }

    /**
     * @param $menuId
     *
     * @return mixed
     */
    public function byId($menuId)
    {
        try {
            $menu = Menu::whereId($menuId)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Flash::warning('Menu could not be found');

            return redirect('/');
        }

        return $menu;
    }

    public function byGroup($group = '*')
    {
        return Menu::with('children')->where('menu_group', $group)
        ->where('parent_id', '0')
        // ->remember(24*60)
        ->orderBy('menu_order', 'asc')
        ->get();
    }

    /**
     * @param $menu
     *
     * @return Menu
     */
    public function create(array $attributes)
    {
        $menu = new Menu();

        $menu->icon = $attributes['icon'];
        $menu->parent_id = $attributes['parent_id'];
        $menu->menu_order = $attributes['menu_order'];
        $menu->title = $attributes['title'];
        $menu->url = $attributes['url'];
        $menu->description = $attributes['description'];
        $menu->permission = $attributes['permission'];
        $menu->menu_group = $attributes['menu_group'];

        $menu->save();

        return $menu;
    }

    /**
     * @param $menuId
     *
     * @return mixed
     */
    public function deleteById($menuId)
    {
        $menu = $this->byId($menuId);

        if ($menu->hasChildren()) {
            $this->updateChildren($menu->children);
        }

        $menu->delete();
    }

    public function updateChildren(Collection $children)
    {
        foreach ($children as $child) {
            $this->update($child, ['parent_id' => 0]);
        }
    }

    public function update(Menu $menu, array $attributes)
    {
        $menu->update($attributes);
    }
}

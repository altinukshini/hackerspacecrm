<?php

namespace HackerspaceCRM\Menu\Repository;

use Flash;
use HackerspaceCRM\Menu\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentMenuRepository implements MenuRepositoryInterface
{
    /**
     * All menus
     *
     * @return Collection
     */
    public function getAll()
    {
        return Menu::all();
    }

    /**
     * Get menu by id.
     *
     * @param $menuId
     */
    public function byId($menuId)
    {
        return Menu::find($menuId);
    }

    /**
     * By group get parent menus with children 
     * ordered by menu_order asc 
     *
     * @param $group
     *
     * @return Collection
     */
    public function byGroup($group = '*')
    {
        return Menu::with('children')->where('menu_group', $group)
        ->where('parent_id', '0')
        ->orderBy('menu_order', 'asc')
        ->get();
    }

    /**
     * Create new menu
     *
     * @param array attributes
     *
     * @return Menu
     */
    public function create(array $attributes)
    {
        $menu = new Menu();

        $menu->icon = $attributes['icon'];
        $menu->menu_order = $attributes['menu_order'];
        $menu->title = $attributes['title'];
        $menu->url = $attributes['url'];
        $menu->permission = $attributes['permission'];
        if (array_key_exists('menu_group', $attributes))
            $menu->menu_group = $attributes['menu_group'];
        if (array_key_exists('parent_id', $attributes))
            $menu->parent_id = $attributes['parent_id'];
        if (array_key_exists('description', $attributes))
            $menu->description = $attributes['description'];

        $menu->save();

        return $menu;
    }

    /**
     * Delete menu by id, but if menu is parent
     * make it's children parents first
     *
     * @param $menuId
     */
    public function deleteById($menuId)
    {
        $menu = $this->byId($menuId);

        if ($menu->hasChildren()) {
            $this->updateChildren($menu->children);
        }

        $menu->delete();
    }

    /**
     * Make menu children parents
     *
     * @param Collection
     *
     * @return void
     */
    public function updateChildren(Collection $children)
    {
        foreach ($children as $child) {
            $this->update($child, ['parent_id' => 0]);
        }
    }

    /**
     * Update menu by given attributes
     *
     * @param Menu
     * @param array atributes
     *
     * @return void
     */
    public function update(Menu $menu, array $attributes)
    {
        $menu->update($attributes);
    }
}

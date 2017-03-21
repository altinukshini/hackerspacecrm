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
        return Menu::with('permission')->get();
    }

    /**
     * Get menu by id.
     *
     * @param $menuId
     */
    public function byId($menuId)
    {
        return Menu::with('permission')->find($menuId);
    }

    /**
     * Get menu by slug.
     *
     * @param $menuSlug
     */
    public function bySlug($menuSlug)
    {
        return Menu::with('permission')->whereSlug($menuSlug)->first();
    }

    /**
     * Replicate menu (translation).
     *
     * @param $menuId
     */
    public function replicate($menuId)
    {
        $menu = $this->byId($menuId);

        if (!is_null($menu)) {
            $clone = $menu->replicate();
            $clone->save();
            return $clone;
        }

        return false;
    }

    /**
     * By group get parent menus with children
     * ordered by menu_order asc
     *
     * @param $group
     *
     * @return Collection
     */
    public function byGroup($group = ['*'])
    {
        return Menu::with('children')->with('permission')->where('menu_group', $group)
        ->where('locale', getCurrentSessionAppLocale())
        ->where(function ($query) {
            $query->whereNull('parent_slug')
                  ->orWhere('parent_slug', '');
        })
        ->orderBy('menu_order', 'asc')
        ->get();
    }

    /**
     * Get parent menus without children
     * ordered by menu_order asc
     *
     * @return Collection
     */
    public function getParents()
    {
        return Menu::where('locale', getCurrentSessionAppLocale())
        ->where(function ($query) {
            $query->whereNull('parent_slug')
                  ->orWhere('parent_slug', '');
        })
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
        $menu->locale = $attributes['locale'];
        $menu->slug = $attributes['slug'];
        $menu->menu_order = $attributes['menu_order'];
        $menu->title = $attributes['title'];
        $menu->url = $attributes['url'];
        $menu->permission_id = $attributes['permission_id'];
        if (array_key_exists('menu_group', $attributes)) {
            $menu->menu_group = $attributes['menu_group'];
        }
        if (array_key_exists('parent_slug', $attributes)) {
            $menu->parent_slug = $attributes['parent_slug'];
        }
        if (array_key_exists('description', $attributes)) {
            $menu->description = $attributes['description'];
        }

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
            $this->update($child, ['parent_slug' => null]);
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

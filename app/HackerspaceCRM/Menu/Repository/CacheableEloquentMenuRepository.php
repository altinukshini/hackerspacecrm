<?php

namespace HackerspaceCRM\Menu\Repository;

use HackerspaceCRM\Menu\Menu;
use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;
use Illuminate\Contracts\Cache\Repository as Cache;

/*
 * Decorator class of HackerspaceCRM\Menu\Repository\EloquentMenuRepository
 */

class CacheableEloquentMenuRepository implements MenuRepositoryInterface
{
    private $menuRepository;

    private $cache;

    public function __construct(MenuRepositoryInterface $menuRepository, Cache $cache)
    {
        $this->menuRepository = $menuRepository;
        $this->cache = $cache;
    }

    /**
     * All menus cached.
     *
     * @return Collection
     */
    public function getAll()
    {
        return $this->cache->tags('menus')->rememberForever('menus.all', function () {
            return $this->menuRepository->getAll();
        });
    }

    /**
     * Get menu by id cached.
     *
     * @param $menuId
     */
    public function byId($menuId)
    {
        return $this->cache->tags('menus')->rememberForever('menus.byId.'.$menuId, function () use ($menuId) {
            return $this->menuRepository->byId($menuId);
        });
    }

    /**
     * Get menu by slug cached.
     *
     * @param $menuSlug
     */
    public function bySlug($menuSlug)
    {
        return $this->cache->tags('menus')->rememberForever('menus.bySlug.'.$menuSlug, function () use ($menuSlug) {
            return $this->menuRepository->bySlug($menuSlug);
        });
    }

    /**
     * Replicate menu (translation).
     *
     * @param $menuId
     */
    public function replicate($menuId)
    {
        return $this->menuRepository->replicate($menuId);
    }

    /**
     * By group get parent menus with children
     * ordered by menu_order asc.
     *
     * @param $group
     *
     * @return Collection
     */
    public function byGroup($group = '*')
    {
        return $this->cache->tags('menus')->rememberForever('menus.byGroup.'.getCurrentSessionAppLocale().'.'.$group, function () use ($group) {
            return $this->menuRepository->byGroup($group);
        });
    }

    /**
     * Get parent menus without children
     * ordered by menu_order asc
     *
     * @return Collection
     */
    public function getParents()
    {
        return $this->cache->tags('menus')->rememberForever('menus.getParents.'.getCurrentSessionAppLocale(), function () {
            return $this->menuRepository->getParents();
        });
    }

    /**
     * Create new menu.
     *
     * @param array attributes
     *
     * @return Menu
     */
    public function create(array $attributes)
    {
        return $this->menuRepository->create($attributes);
    }

    /**
     * Delete menu by id, but if menu is parent
     * make it's children parents first.
     *
     * @param $menuId
     */
    public function deleteById($menuId)
    {
        return $this->menuRepository->deleteById($menuId);
    }

    /**
     * Update menu by given attributes.
     *
     * @param Menu
     * @param array atributes
     */
    public function update(Menu $menu, array $attributes)
    {
        return $this->menuRepository->update($menu, $attributes);
    }
}

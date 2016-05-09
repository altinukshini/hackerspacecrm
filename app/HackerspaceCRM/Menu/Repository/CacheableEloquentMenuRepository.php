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
        return $this->cache->remember('menus.all', 24 * 60, function () {
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
        return $this->cache->remember('menus.byId.'.$menuId, 24 * 60, function () use ($menuId) {
            return $this->menuRepository->byId($menuId);
        });
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
        return $this->cache->remember('menus.byGroup.'.$group, 24 * 60, function () use ($group) {
            return $this->menuRepository->byGroup($group);
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

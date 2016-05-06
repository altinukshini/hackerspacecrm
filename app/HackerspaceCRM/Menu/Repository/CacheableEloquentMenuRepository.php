<?php 

namespace HackerspaceCRM\Menu\Repository;

use Flash;
use HackerspaceCRM\Menu\Menu;
use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CacheableEloquentMenuRepository implements MenuRepositoryInterface 
{
	private $menuRepository;
	private $cache;

	public function __construct(MenuRepositoryInterface $menuRepository, Cache $cache)
	{
		$this->menuRepository = $menuRepository;
		$this->cache = $cache;
	}

	public function getAll()
    {
    	return $this->cache->remember('menus.all', 24*60, function() {
    		return $this->menuRepository->getAll();
    	});
    }

    /**
     * @param $menuId
     *
     * @return mixed
     */
    public function byId($menuId)
    {
        return $this->cache->remember('menus.byId', 24*60, function() use ($menuId){
    		return $this->menuRepository->byId($menuId);
    	});
    }

    public function byGroup($group = '*')
    {
    	return $this->cache->remember('menus.byGroup.'.$group, 24*60, function() use ($group){
    		return $this->menuRepository->byGroup($group);
    	});
    }

    /**
     * @param $menu
     *
     * @return Menu
     */
    public function create(array $attributes)
    {
        return $this->menuRepository->create($attributes);
    }

    /**
     * @param $menuId
     *
     * @return mixed
     */
    public function deleteById($menuId)
    {
        return $this->menuRepository->deleteById($menuId);
    }

    public function update(Menu $menu, array $attributes)
    {
        return $this->menuRepository->update($menu, $attributes);
    }
}
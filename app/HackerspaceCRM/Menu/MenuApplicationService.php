<?php

namespace HackerspaceCRM\Menu;

use HackerspaceCRM\Menu\Menu;
use Illuminate\Support\Facades\App;
use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;

class MenuApplicationService
{

    /**
     * Create new menu
     *
     * @return array
     *
     * @return Menu
     **/
    public function create(array $menu)
    {
        $menuRepository = App::make(MenuRepositoryInterface::class);
        $menu = $menuRepository->create($menu);

        return $menu;
    }

    /**
     * Delete menu by id
     *
     * @param menuId
     *
     * @return void
     **/
    public function delete($menuId)
    {
        $menuRepository = App::make(MenuRepositoryInterface::class);
        $menuRepository->deleteById($menuId);
    }

    /**
     * Update menu
     *
     * @param Menu
     * @param array attributes
     *
     * @return void
     **/
    public function update(Menu $menu, array $attributes)
    {
        $menuRepository = App::make(MenuRepositoryInterface::class);
        $menuRepository->update($menu, $attributes);
    }

}
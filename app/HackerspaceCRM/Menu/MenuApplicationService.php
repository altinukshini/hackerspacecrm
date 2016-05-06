<?php

namespace HackerspaceCRM\Menu;

use Illuminate\Support\Facades\App;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

use HackerspaceCRM\Menu\Menu;
use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;


class MenuApplicationService
{

    /**
     * @return Menu
     */
    public function create($menu)
    {
        $menuRepository = App::make(MenuRepositoryInterface::class);
        $menu = $menuRepository->create($menu);

        return $menu;
    }

    /**
     * @param $menuId
     */
    public function delete($menuId)
    {
        $menuRepository = App::make(MenuRepositoryInterface::class);
        $menuRepository->deleteById($menuId);
    }

    public function update(Menu $menu, array $attributes)
    {
        $menuRepository = App::make(MenuRepositoryInterface::class);
        $menuRepository->update($menu, $attributes);
    }

}
<?php

namespace HackerspaceCRM\Menu\Repository;

use HackerspaceCRM\Menu\Menu;

interface MenuRepositoryInterface
{
    public function getAll();
    public function create(array $attributes);
    public function update(Menu $menu, array $attributes);
    public function deleteById($menuId);
    public function byId($id);
    public function byGroup($group);
}

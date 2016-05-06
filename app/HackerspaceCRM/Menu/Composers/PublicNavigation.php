<?php

namespace HackerspaceCRM\Menu\Composers;

use Illuminate\Contracts\View\View;
use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;

class PublicNavigation
{
    protected $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function compose(View $view)
    {
        $view->with('public', $this->menuRepository->byGroup('public'));
    }
}

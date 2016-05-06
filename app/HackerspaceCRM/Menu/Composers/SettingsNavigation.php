<?php

namespace HackerspaceCRM\Menu\Composers;

use Illuminate\Contracts\View\View;
use HackerspaceCRM\Menu\Repository\EloquentMenuRepository;

class SettingsNavigation
{
    protected $menuRepository;

    public function __construct(EloquentMenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function compose(View $view)
    {
        $view->with('settings', $this->menuRepository->byGroup('settings'));
    }
}

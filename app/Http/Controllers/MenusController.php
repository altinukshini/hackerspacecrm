<?php

namespace App\Http\Controllers;

use Flash;
use App\Http\Requests\AddMenuRequest;
use App\Http\Requests\EditMenuRequest;
use HackerspaceCRM\Menu\MenuApplicationService;
use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;

class MenusController extends Controller
{
    private $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;

        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function show()
    {
        $menus = [
            'public' => $this->menuRepository->byGroup('public'),
            'main' => $this->menuRepository->byGroup('main'),
            'settings' => $this->menuRepository->byGroup('settings'),
        ];

        return view('settings.menus')->with('menus', $menus);
    }

    public function getMenu($menuId)
    {
        // see if user has permission to view menu
        if (!hasPermission('menu_view', true)) return back();

        return $this->menuRepository->byId($menuId);
    }

    /**
     * @param AddMenuRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(AddMenuRequest $request)
    {
        $menuApplicationService = new MenuApplicationService();
        $menu = $menuApplicationService->create($request->all());

        if ($request->wantsJson()) {
            return $menu;
        }

        Flash::success('Menu was created successfully');

        return back();
    }

    /**
     * @param App\Http\Requests\AddMenuRequest
     * @param menuId
     */
    public function update(EditMenuRequest $request, $menuId)
    {
        $menuApplicationService = new MenuApplicationService();
        $menu = $this->menuRepository->byId($menuId);

        $menuApplicationService->update($menu, $request->all());

        Flash::success('Menu updated successfully');

        return back();
    }

    /**
     * @param $menuId
     */
    public function delete($menuId)
    {
        // see if user has permission to delete menu
        if (!hasPermission('menu_delete', true)) {
            return back();
        }

        $menuApplicationService = new MenuApplicationService();
        $menu = $this->menuRepository->byId($menuId);

        $menuApplicationService->delete($menuId);

        Flash::success('Menu was successfully deleted!');

        return back();
    }
}

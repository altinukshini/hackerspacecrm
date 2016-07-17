<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use HackerspaceCRM\Menu\Menu;
use App\Http\Requests\CreateMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use HackerspaceCRM\Menu\MenuApplicationService;
use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;

class MenusController extends Controller
{

    /**
     * Instance of HackerspaceCRM\Menu\Repository\MenuRepositoryInterface
     *
     * @var Object
     */
    private $menuRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;

        $this->middleware('auth');
        $this->middleware('permission:menu_view'); 
    }

    /**
     * Show all menus /settings/menus
     *
     * @return View;
     **/
    public function show()
    {
        $menus = [
            'public' => $this->menuRepository->byGroup('public'),
            'main' => $this->menuRepository->byGroup('main'),
            'settings' => $this->menuRepository->byGroup('settings'),
        ];

        return view('settings.menus')->with('menus', $menus);
    }

    /**
     * Get a single menu as JSON for the editMenu ajax call in menus.blade.php
     *
     * @return Menu
     **/
    public function getMenu(Request $request, $menuId)
    {
        if (!$request->wantsJson()) {
            return redirect('/');
        }

        return $this->menuRepository->byId($menuId);
    }

    /**
     * @param CreateMenuRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(CreateMenuRequest $request)
    {
        // see if user has permission to create menu
        if (!hasPermission('menu_create', true)) return back();

        $menuApplicationService = new MenuApplicationService();

        $requestArray = $this->normalizeNewMenuRequest($request);

        $menu = $menuApplicationService->create($requestArray);

        Flash::success(trans('hackerspacecrm.messages.models.create.success', ['modelname' => trans('hackerspacecrm.models.menu')]));

        return back();
    }

    /**
     * Update an existing menu
     *
     * @param App\Http\Requests\UpdateMenuRequest
     * @param menuId
     */
    public function update(UpdateMenuRequest $request, $menuId)
    {
        // see if user has permission to update menu
        if (!hasPermission('menu_update', true)) return back();

        $menuApplicationService = new MenuApplicationService();
        $menu = $this->menuRepository->byId($menuId);

        $requestArray = $this->normalizeNewMenuRequest($request);

        $menuApplicationService->update($menu, $requestArray);

        Flash::success(trans('hackerspacecrm.messages.models.update.success', ['modelname' => trans('hackerspacecrm.models.menu')]));

        return back();
    }

    /**
     * Delete an existing menu by id
     *
     * @param $menuId
     */
    public function delete($menuId)
    {
        // see if user has permission to delete menu
        if (!hasPermission('menu_delete', true)) return back();

        $menuApplicationService = new MenuApplicationService();
        $menu = $this->menuRepository->byId($menuId);

        $menuApplicationService->delete($menuId);

        Flash::success(trans('hackerspacecrm.messages.models.delete.success', ['modelname' => trans('hackerspacecrm.models.menu')]));

        return back();
    }

    /**
     * Normalize the menu fields in request. When new menu has a parent specified,
     * this will check if the menu is child of child and fix it (changes it to child of parent),
     * and it will change the given menu group if it is different from its parent's
     *
     * @param Request
     * @return array
     **/
    public function normalizeNewMenuRequest(Request $request)
    {
        if ( $request->has('parent_id') && $request->input('parent_id') != 0) {
            
            $parent = $this->menuRepository->byId($request->input('parent_id'));
            $requestArray = $request->all();

            return $this->normalizeRelations($parent, $requestArray);
        }
        return $request->all();
    }

    public function normalizeRelations(Menu $parent, array $requestArray)
    {
        if ($parent->menu_group != $requestArray['menu_group']) {
            
            $requestArray['menu_group'] = $parent->menu_group;

            return $this->normalizeParentId($parent, $requestArray);
        }

        return $this->normalizeParentId($parent, $requestArray);
    }

    public function normalizeParentId(Menu $parent, array $requestArray)
    {
        if ($parent->hasParent()) {
            $requestArray['parent_id'] = $parent->parent_id;

            return $requestArray;
        }

        return $requestArray;
    }
}

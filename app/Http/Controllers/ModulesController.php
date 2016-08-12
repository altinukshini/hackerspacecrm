<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App\Manager\ModuleManager;
use Nwidart\Modules\Module;
use Nwidart\Modules\Repository;
use Symfony\Component\Console\Output\BufferedOutput;

class ModulesController extends Controller
{

    /**
     * @var ModuleManager
     */
    private $moduleManager;

    /**
     * @var Repository
     */
    private $modules;

    public function __construct(ModuleManager $moduleManager, Repository $modules)
    {
        $this->moduleManager = $moduleManager;
        $this->modules = $modules;
    }

    /**
     * Display a list of all modules
     * @return View
     */
    public function all()
    {
        $modules = $this->modules->all();

        return view('modules.all', compact('modules'));
    }

    /**
     * Display module info
     *
     * @param Module $module
     *
     * @return View
     */
    public function show(Module $module)
    {

    }

    /**
     * Disable the given module
     *
     * @param Module $module
     *
     * @return mixed
     */
    public function disable(Module $module)
    {

    }

    /**
     * Enable the given module
     *
     * @param Module $module
     *
     * @return mixed
     */
    public function enable(Module $module)
    {

    }

    /**
     * Update a given module
     *
     * @param Request $request
     *
     * @return Response json
     */
    public function update(Request $request)
    {

    }

    /**
     * Check if the given module is a core module that should not be disabled
     *
     * @param Module $module
     *
     * @return bool
     */
    private function isCoreModule(Module $module)
    {

    }
}

<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Menu;

class SettingsController extends Controller
{
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');

        $this->menu = $menu;
    }

    //
    // CLEAN THIS UP!!!
    //
    


}

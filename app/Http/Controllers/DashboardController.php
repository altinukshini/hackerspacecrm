<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:administrator');
        // $this->middleware('permission:edit_member');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!hasRole('administrator', true)) return back();
        // if (!hasPermission('sell_company', true)) return back();

        return view('dashboard');
    }
}

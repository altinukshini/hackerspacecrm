<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
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
        if (!hasRole('member', true)) {
            return back();
        }
        // if (!hasPermission('sell_company', true)) return back();

        return view('dashboard');
    }
}

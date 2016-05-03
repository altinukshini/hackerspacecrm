<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param $username
     * @return Response
     */
    public function show($username)
    {
        // TODO: Open user profile only if member and has profile
    	// Handle Model not found exceptions in global.php
    	try {

    		$user = User::whereUsername($username)->firstOrFail();

            if ($user->hasProfile()) {

                $user->load('profile.user');

                return view('profiles.show', compact('user'));
            }

    	} catch (ModelNotFoundException $e) {

    		return redirect('/');
            
    	}

        return redirect('/');
    	
    }

}

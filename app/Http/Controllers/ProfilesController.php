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
    	// Handle Model not found exceptions in global.php
    	try {
    		$user = User::with('profile')->whereUsername($username)->firstOrFail();
    		// $user->load('profile.user');
    		// dd($user->toArray());
    	} catch (ModelNotFoundException $e) {
    		return redirect('/');
    	}
    	return view('profiles.show', compact('user'));
    }

}

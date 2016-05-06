<?php

namespace App\Http\Controllers;

use Flash;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param $username
     *
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

        Flash::info('You do not have a profile created yet!');

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Flash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        Flash:info('Page not created yet');

        return redirect('/');
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
        $user = User::whereUsername($username)->first();

        if (!is_null($user) && $user->hasProfile()) {
            $user->load('profile.user');

            return view('profiles.show', compact('user'));
        }

        Flash::info('No profile with username: '.$username);

        return redirect('/');
    }

    public function update(UpdateProfileRequest $request, $username)
    {
        $user = User::with('profile')->whereUsername($username)->first();

        if (!is_null($user) && $user->hasProfile()) {

            $user->profile->update($request->all());

            Flash::success('Profile updated successfully');

            return back();
        }

        Flash::info('No user with username: '.$username);

        return redirect('/');
    }
}

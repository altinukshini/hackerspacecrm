<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Auth;
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
        Flash::info('Page not created yet');

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

        // Flash::info('No profile with username: '.$username);

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

    public function showCreateForm($username)
    {
        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info('There is no user with username: '.$username);
            return redirect('/');
        }

        if(!(hasPermission('profile_create') || (Auth::user()->hasRole('member') && Auth::user()->username == $username))) {
            Flash::warning('You do not have the right permission to perform this action');
            return redirect('/');
        }

        if ($user->hasProfile()) {
            return redirect($user->profilePath());
        }
        
        return view('profiles.create', compact('user'));

    }

    public function create(CreateProfileRequest $request, $username)
    {
        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info('There is no user with username: '.$username);
            return redirect('/');
        }

        if ($user->hasProfile()) {
            return redirect($user->profilePath());
        }

        $profile = new Profile($request->all());
        $profile->user_id = $user->id;

        $user->profile()->save($profile);

        Flash::success('Profile successfully created');

        return redirect($user->fresh()->profilePath());

    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use Flash;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
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
     * Show all profiles in /members
     *
     * @return View;
     **/
    public function all()
    {
        Flash::info('Page not created yet');

        return redirect('/');
    }

    /**
     * Show a members profile
     *
     * @param $username
     *
     * @return View
     */
    public function show($username)
    {
        $user = User::whereUsername($username)->first();

        if (is_null($user) || !$user->hasProfile()) {
            Flash::info('No profile with username: '.$username);
            return redirect('/');
        }

        $user->load('profile.user');

        return view('profiles.show', compact('user'));
    }

    /**
     * Update profile data
     *
     * @param App\Http\Requests\UpdateProfileRequest
     * @param string
     *
     * @return Void;
     **/
    public function update(UpdateProfileRequest $request, $username)
    {
        $user = User::with('profile')->whereUsername($username)->first();

        if (is_null($user) || !$user->hasProfile()) {
            Flash::info('No user with username: '.$username);
            return redirect('/');
        }

        $user->profile->update($request->all());

        Flash::success('Profile updated successfully');

        return back();       
    }

    /**
     * Show create profile form for a user
     *
     * @param string
     *
     * @return View;
     **/
    public function showCreateForm($username)
    {
        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info('There is no user with username: '.$username);
            return redirect('/');
        }

        // check if user has permission to create profile, or if a member, create his/her own profile
        if(!(hasPermission('profile_create') || (Auth::user()->hasRole('member') && Auth::user()->username == $username))) {
            Flash::warning('You do not have the right permission to perform this action');
            return redirect('/');
        }

        // if already has profile, redirect to it
        if ($user->hasProfile()) {
            return redirect($user->profilePath());
        }
        
        return view('profiles.create', compact('user'));

    }

    /**
     * Create profile for a user
     *
     * @param App\Http\Requests\CreateProfileRequest
     * @param string
     *
     * @return Void;
     **/
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

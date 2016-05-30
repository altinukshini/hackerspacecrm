<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;

use App\Models\User;
use Flash;

class UsersController extends Controller
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
     * Show all users in /users
     *
     * @return View;
     **/
    public function all()
    {
        if (!hasPermission('user_view', true)) return redirect('/');

        $users = User::all();

        return view('settings.users.all')->with('users', $users);
    }

    /**
     * Get data for one user as json
     *
     * @param string
     * @return App\Models\User;
     **/
    public function getUser($username)
    {
        // see if user has permission to view another user
        if (!hasPermission('user_view', true) || Auth::user()->username != $username) return redirect('/');

        return User::whereUsername($username)->first();
    }

    /**
     * Update user data
     *
     * @param App\Http\Requests\UpdateUserRequest
     * @param string
     *
     * @return Void;
     **/
    public function update(UpdateUserRequest $request, $username)
    {
        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info('No user with username: '.$username);
            return redirect('/');
        }

        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');

        $user->save();

        Flash::success('User info updated successfully');

        return back();
    }

    /**
     * Delete user
     *
     * @param string
     * @return Void;
     **/
    public function delete($username)
    {
        // see if user has permission to delete menu
        if (!hasPermission('user_delete', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        if(is_null($user) || $username == 'admin') {
            Flash::error('User could not be deleted!');
            return back();
        }

        $user->delete();

        Flash::success('User was successfully deleted!');

        return back(); 
    }

    /**
     * Change password for user
     *
     * @param App\Http\Requests\UpdateUserPasswordRequest
     * @param string
     *
     * @return Void;
     **/
    public function changePassword(UpdateUserPasswordRequest $request, $username)
    {
        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info('No user with username: '.$username);
            return redirect('/');
        }

        $user->password = $this->encryptPassword($request->input('password'));

        $user->save();

        Flash::success('User password changed successfully');

        return back();
    }

    /**
     * Encrypt password
     *
     * @param string
     * @return string;
     **/
    public function encryptPassword($password)
    {
        return bcrypt($password);
    }
}

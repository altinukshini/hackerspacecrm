<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;

use App\Models\User;
use Flash;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        if (!hasPermission('user_update', true)) return redirect('/');

        $users = User::all();

        return view('settings.users.all')->with('users', $users);
    }

    public function getUser($username)
    {
        // see if user has permission to view menu
        if (!hasPermission('user_view', true)) return redirect('/');

        return User::whereUsername($username)->first();
    }

    public function show()
    {
        Flash:info('Page not created yet');

        return redirect('/');
    }

    public function create()
    {
        Flash:info('Page not created yet');

        return redirect('/');
    }

    public function update(UpdateUserRequest $request, $username)
    {
        if(!(hasPermission('user_update') || Auth::user()->username == $username)) {
            Flash::warning('You do not have the right permission to perform this action');
            return redirect('/');
        }

        $user = User::whereUsername($username)->first();

        if (!is_null($user)) {
            $user->full_name = $request->input('full_name');
            $user->email = $request->input('email');

            $user->save();

            Flash::success('User info updated successfully');

            return back();
        }

        Flash::info('No user with username: '.$username);

        return redirect('/');
    }

    public function delete($username)
    {
        // see if user has permission to delete menu
        if (!hasPermission('user_delete', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        if(!is_null($user) && $username != 'admin') {
            $user->delete();
            Flash::success('User was successfully deleted!');
            return back();
        }

        Flash::error('User could not be deleted!');

        return back();
    }

    public function changePassword(UpdateUserPasswordRequest $request, $username)
    {

        if(!(hasPermission('user_update') || Auth::user()->username == $username)) {
            Flash::warning('You do not have the right permission to perform this action');
            return redirect('/');
        }

        $user = User::whereUsername($username)->first();

        if (!is_null($user)) {
            $user->password = $this->encryptPassword($request->input('password'));

            $user->save();

            Flash::success('User password changed successfully');

            return back();
        }

        Flash::info('No user with username: '.$username);

        return redirect('/');
    }

    public function encryptPassword($password)
    {
        return bcrypt($password);
    }
}

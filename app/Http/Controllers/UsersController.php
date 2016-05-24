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
        Flash:info('Page not created yet');

        return redirect('/');
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

    public function delete()
    {
    }

    public function changePassword(UpdateUserPasswordRequest $request, $username)
    {

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

<?php

namespace App\Http\Controllers;

use Auth;
use Flash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use HackerspaceCRM\Mailers\UserMailer as Mailer;


class UsersController extends Controller
{

    protected $mailer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth');
        $this->mailer = $mailer;
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

        if (request()->wantsJson()) {
            return $users;
        }

        return view('settings.users.all')->with('users', $users);
    }

    /**
     * Show all users in /users
     *
     * @return View;
     **/
    public function showUpdateUserForm($username)
    {
        // see if user has permission to update user
        if (!(Auth::user()->username == $username || hasPermission('user_update', true))) return redirect('/');

        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info('Requested user does not exist!');
            return redirect('/');
        }

        if ($user->hasProfile()) {
            return redirect($user->profilePath());
        }

        return view('settings.users.edit')->with(compact('user'));
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
        if (!(hasPermission('user_view', true) || Auth::user()->username == $username)) return redirect('/');

        if (!request()->wantsJson()) {
            return redirect('/');
        }

        return User::whereUsername($username)->first();
    }

    /**
     * Create user
     *
     * @param App\Http\Requests\CreateUserRequest
     * @param string
     *
     * @return Void;
     **/
    public function create(CreateUserRequest $request)
    {
        $user = User::create([
            'full_name' => $request->input('full_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $user->verified = 1;
        $user->email_token = null;
        $user->save();

        $user->assignRoleByName(crminfo('new_user_role'));

        if ($request->input('notify') == 'yes') {
            $data['password'] = $request->input('password');
            $data['edit_link'] = url('/users/'.$user->username.'/edit');
            $data['reset_link'] = url('/password/reset');
            
            $this->mailer->mail($user, 'newaccount', $data);
        }

        if ($request->wantsJson()) {
            return $user;
        }

        Flash::success('User created successfully');

        return back();
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

        // $user->update($request->all());
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->save();

        Flash::success('User info updated successfully');

        return back();
    }

    /**
     * Verify user
     *
     * @param string $username;
     *
     * @return Void;
     **/
    public function verify($username)
    {
        if (!hasPermission('user_update', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info('No user with username: '.$username);
            return redirect('/');
        }

        $user->verified = 1;
        $user->email_token = null;
        $user->save();

        Flash::success('User verified successfully');

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
        // see if authenticated user has permission to delete users
        if (!hasPermission('user_delete', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        if(is_null($user)) {
            Flash::error('Username could not be found!');
            return back();
        }

        if ($username == crminfo('admin_username')) {
            Flash::error('You can not delete the CRM Administrator user!');
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

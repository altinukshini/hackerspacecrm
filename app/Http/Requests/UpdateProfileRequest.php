<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Flash;

class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!(hasPermission('profile_update') || (Auth::user()->hasRole('member') && Auth::user()->username == $this->route('username')))) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'birthday' => 'required|string|date_format:Y-m-d',
            'gender' => 'required|string',
            'socialid' => 'sometimes|string',
            'phone' => 'sometimes|string|max:18',
            'address' => 'sometimes|string',
            'website' => 'sometimes|url',
            'github_username' => 'sometimes|string',
            'facebook_username' => 'sometimes|string',
            'twitter_username' => 'sometimes|string',
            'linkedin_username' => 'sometimes|string',
            'skills' => 'sometimes|string',
            'biography' => 'sometimes|string',
        ];
    }

    /**
     * Get the response for a forbidden operation.
     */
    public function forbiddenResponse()
    {
        Flash::error(trans('hackerspacecrm.messages.nopermission'));
        return back();
    }
}

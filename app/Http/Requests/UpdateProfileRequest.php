<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $username = $this->route('username');

        if (hasPermission('profile_update') || Auth::user()->username == $username) {
            return true;
        }

        return false;
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
            'socialid' => 'required|string',
            'phone' => 'sometimes|string|size:11',
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
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Http\Requests\Request;
use App\Models\User;
use Auth;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $username = $this->route('username');

        if (hasPermission('user_update') || Auth::user()->username == $username) {
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
        $user = User::whereUsername($this->route('username'))->first();
        return [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];
    }

    /**
    * {@inheritdoc}
    */
    protected function formatErrors(Validator $validator)
    {
        $validator->errors()->add('error_code', '6');
        return parent::formatErrors($validator);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Requests\Request;
use App\Models\User;
use Auth;
use Flash;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (hasPermission('user_update') || Auth::user()->username == $this->route('username')) {
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

    /**
     * Get the response for a forbidden operation.
     */
    public function forbiddenResponse()
    {
        Flash::error(trans('hackerspacecrm.messages.nopermission'));
        return back();
    }
}

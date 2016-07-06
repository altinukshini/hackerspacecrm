<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Http\Requests\Request;
use App\Models\User;
use Auth;
use Flash;

class UpdateUserPasswordRequest extends Request
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
        return [
            'password' => 'required|min:6|confirmed',
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
        Flash::error('You do not have the right permission to perform this action');
        return back();
    }
}

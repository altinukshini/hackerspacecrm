<?php

namespace App\Http\Requests;

use Flash;
use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class CreateRoleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return hasPermission('role_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|no_specials_lower_u|unique:roles,name',
            'label' => 'required|string'
        ];
    }

    /**
    * {@inheritdoc}
    */
    protected function formatErrors(Validator $validator)
    {
        $validator->errors()->add('error_code', '5');
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

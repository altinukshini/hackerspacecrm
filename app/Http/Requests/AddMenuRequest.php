<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class AddMenuRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return hasPermission('menu_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon' => 'required|string',
            'parent_id' => 'sometimes|integer|min:0|exists:menus,id',
            'menu_order' => 'required|integer|min:0',
            'title' => 'required|string|max:100',
            // 'url' => '', not required, can be empty
            // 'description' => '', not required, can be empty
            'permission' => 'required|string',
            'menu_group' => 'required|string|in:'.implode(",", crminfo('menu_groups')),
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

}

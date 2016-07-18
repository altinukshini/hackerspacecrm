<?php

namespace App\Http\Requests;

use Flash;
use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class TranslateMenuRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return hasPermission('menu_update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Get slug of the entered menu
        $menuRepository = app()->make('HackerspaceCRM\Menu\Repository\MenuRepositoryInterface');
        $slug = $menuRepository->byId($this->route('menuId'))->slug;

        return [
            'locale' => 'required|string|in:'.implode(",", getAvailableAppLocaleArrayKeys()).'|unique:menus,locale,NULL,id,slug,'.$slug
        ];
    }

    /**
    * {@inheritdoc}
    */
    protected function formatErrors(Validator $validator)
    {
        $validator->errors()->add('error_code', '7');
        return parent::formatErrors($validator);
    }

    /**
     * Get the response for a forbidden operation.
     */
    public function forbiddenResponse()
    {
        // Flash::error(trans('hackerspacecrm.messages.nopermission'));
        return back();
    }
}

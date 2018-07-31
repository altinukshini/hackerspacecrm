<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Flash;
use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class UpdateGeneralSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return hasPermission('setting_update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'crmname' => 'required|string',
            'crmdescription' => 'sometimes|string',
            'orgname' => 'required|string',
            'orgdescription' => 'sometimes|string',
            'address' => 'sometimes|string',
            'locale' => 'required|string|in:'.implode(",", array_keys(crminfo('supported_locales'))),
            'enable_registration' => 'sometimes|integer|min:0|max:1',
            'new_user_role' => 'required|string|exists:roles,name',
            'url' => 'required|string',
            'crmfooter' => 'required|string',
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

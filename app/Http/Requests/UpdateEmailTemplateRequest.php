<?php

namespace App\Http\Requests;

use Flash;
use App\Http\Requests\Request;

class UpdateEmailTemplateRequest extends Request
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
            'email_subject' => 'required|string',
            'email_body' => 'required|string'
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

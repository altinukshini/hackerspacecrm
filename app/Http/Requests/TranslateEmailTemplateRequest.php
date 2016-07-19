<?php

namespace App\Http\Requests;

use Flash;
use App\Http\Requests\Request;
use App\Models\EmailTemplate;
use Illuminate\Contracts\Validation\Validator;

class TranslateEmailTemplateRequest extends Request
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
        // Get slug of the entered menu
        $template = EmailTemplate::find($this->route('templateId'));
        $slug = $template->slug;

        return [
            'locale' => 'required|string|in:'.implode(",", getAvailableAppLocaleArrayKeys()).'|unique:email_templates,locale,NULL,id,slug,'.$slug
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
        Flash::error(trans('hackerspacecrm.messages.nopermission'));
        return back();
    }
}

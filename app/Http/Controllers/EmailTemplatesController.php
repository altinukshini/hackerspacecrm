<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TranslateEmailTemplateRequest;
use App\Http\Requests\UpdateEmailTemplateRequest;
use App\Models\EmailTemplate;
use HackerspaceCRM\Flasher\Facades\Flash;
use Illuminate\Http\Request;

class EmailTemplatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:setting_update');
    }

    /**
     * Show email templates in /settings/emails
     *
     * @return View;
     **/
    public function showEmailTemplatesForm()
    {
        $emailTemplates = EmailTemplate::whereLocale(getCurrentSessionAppLocale())->get();

        if (request()->wantsJson()) {
        	return $emailTemplates;
        }

        return view('settings.emails', compact('emailTemplates'));
    }

    /**
     * Update email template
     *
     * @param App\Http\Requests\UpdateEmailTemplateRequest $request
     * @param integer $templateId
     *
     * @return View;
     **/
    public function update(UpdateEmailTemplateRequest $request, $templateId)
    {
        $emailTemplate = EmailTemplate::find($templateId);

        if (is_null($emailTemplate)) {
        	Flash::error(trans('hackerspacecrm.messages.models.notexist', ['modelname' => trans('hackerspacecrm.models.emailtemplate')]));
        	return back();
        }

        $emailTemplate->update($request->all());

        Flash::success(trans('hackerspacecrm.messages.models.update.success', ['modelname' => trans('hackerspacecrm.models.emailtemplate')]));

        return back();
    }

    /**
     * Translate an existing EmailTemplate
     *
     * @param App\Http\Requests\TranslateEmailTemplateRequest
     * @param templateId
     */
    public function translate(TranslateEmailTemplateRequest $request, $templateId)
    {
        // see if user has permission to update menu
        if (!hasPermission('setting_update', true)) return back();

        $template = EmailTemplate::find($templateId);

        if (is_null($template)) {
            Flash::error(trans('hackerspacecrm.messages.models.notexist', ['modelname' => trans('hackerspacecrm.models.emailtemplate')]));
            return back();
        }

        $clone = $template->replicate();
        $clone->locale = $request->input('locale');
        $clone->save();

        Flash::success(trans('hackerspacecrm.messages.models.translate.success', ['modelname' => trans('hackerspacecrm.models.emailtemplate')]));

        return back();
    }
}

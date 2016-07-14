<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
        $emailTemplates = EmailTemplate::all();

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
        	Flash::error('EmailTemplate does not exist');
        	return back();
        }

        $emailTemplate->update($request->all());

        Flash::success('Email template updated successfully!');

        return back();
    }
}

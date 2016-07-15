<?php

namespace HackerspaceCRM\Mailers;

use Config;
use App\Models\EmailTemplate;
use App\Models\User;
use HackerspaceCRM\Mailers\EmailAddress;
use HackerspaceCRM\Mailers\Mailer;

class UserMailer extends Mailer
{
	/*
	 * @var
	 */
	protected $view;
	protected $emailTemplate;
	protected $data = [];
	protected $subject;
	protected $fromEmail;
	protected $fromName;
	protected $toEmail;

	/*
	 * @param HackerspaceCRM\Mailers\Mailer $mailer
	 */
	public function __construct()
	{
		$this->fromName = Config::get('mail.from.name');
		$this->fromEmail = Config::get('mail.from.address');
		$this->data['crm'] = (object) CRMSettings();
	}

	/*
	 * Send email template to a user with given data
	 *
	 * @param App\Models\User $user
	 * @param string
	 * @param array
	 * @return void
	 */
	public function mail(User $user, $template, array $data = array())
	{
		$this->emailTemplate = EmailTemplate::whereSlug($template)->firstOrFail();
		$this->toEmail = $user->email;

		$this->data += array_merge(compact('user'), $data);

		return $this->sendEmail();
	}

	/*
	 * Send email template to a user with given data
	 *
	 * @param App\Models\User $user
	 * @param string
	 * @param array
	 * @return void
	 */
	public function mailView(User $user, $view, $subject, array $data = array())
	{
		$this->toEmail = $user->email;
		$this->subject = $subject;
		$this->view = $view;

		$this->data += array_merge(compact('user'), $data);

		return $this->sendEmail('view');
	}

	/*
	 * Send email with class properties
	 *
	 * @return void
	 */
	public function sendEmail($type = null)
	{

		if (is_null($type)) {
			return $this->deliverDB(
				$this->emailTemplate,
				$this->fromName, 
				new EmailAddress($this->fromEmail), 
				new EmailAddress($this->toEmail),
				$this->data
			);
		}

		return $this->deliverView(
			$this->view, 
			$this->subject, 
			$this->fromName, 
			new EmailAddress($this->fromEmail), 
			new EmailAddress($this->toEmail),
			$this->data
		);
	}
	

}
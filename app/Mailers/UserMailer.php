<?php

namespace App\Mailers;

use Config;
use App\Models\User;
use App\Mailers\Mailer;
use App\Mailers\EmailAddress;

class UserMailer extends Mailer
{
	/*
	 * @var
	 */
	protected $view;
	protected $data = [];
	protected $subject;
	protected $to;
	protected $fromEmail;
	protected $fromName;
	
	/*
	 * @param App\Mailers\Mailer $mailer
	 */
	public function __construct()
	{
		$this->fromName = Config::get('mail.from.name');
		$this->fromEmail = Config::get('mail.from.address');
	}

	/*
	 * Send email confirmation email to User
	 *
	 * @param App\Models\User $user
	 * @return void
	 */
	public function confirmation(User $user)
	{
		$this->to = $user->email;
		$this->subject = 'Email confirmation required';
		$this->view = 'emails.confirmation';
		$this->data = compact('user');

		return $this->sendEmail();
	}

	/*
	 * Send welcome email to User
	 *
	 * @param App\Models\User $user
	 * @return void
	 */
	public function welcome(User $user)
	{
		$this->to = $user->email;
		$this->subject = 'Welcome to '.crminfo('name');
		$this->view = 'emails.welcome';
		$this->data = compact('user');

		return $this->sendEmail();
	}

	/*
	 * Send email with class properties
	 *
	 * @return void
	 */
	public function sendEmail()
	{
		return $this->deliver(
			$this->view, 
			$this->subject, 
			$this->fromName, 
			new EmailAddress($this->fromEmail), 
			new EmailAddress($this->to),
			$this->data
		);
	}
	

}
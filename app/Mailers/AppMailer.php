<?php

namespace App\Mailers;

use Config;
use App\Models\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{
	protected $mailer;
	protected $fromEmail;
	protected $fromName;
	protected $to;
	protected $view;
	protected $data = [];

	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
		$this->fromEmail = Config::get('mail.from.address');
		$this->fromName = Config::get('mail.from.name');
	}

	public function sendEmailConfirmationTo(User $user)
	{
		$this->to = $user->email;
		$this->view = 'emails.confirmation';
		$this->data = compact('user');

		$this->deliver();
	}

	public function deliver()
	{
		$this->mailer->send($this->view, $this->data, function($message) {
			$message->from($this->fromEmail, $this->fromName)
					->to($this->to);
		});
	}
	

}
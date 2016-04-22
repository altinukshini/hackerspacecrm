<?php

namespace App\Mailers;

use Mail;
use App\Mailers\EmailAddress;

abstract class Mailer
{

	/* 
	 * Deliver email
	 *
	 * @param $view
	 * @param $subject
	 * @param $fromName
	 * @param App\Mailers\EmailAddress $fromEmail
	 * @param App\Mailers\EmailAddress $to
	 * @param $data
	 */
	public function deliver($view, $subject, $fromName, EmailAddress $fromEmail, EmailAddress $to, $data = array())
	{
		$this->validateParameters($view, $subject, $fromName);

		return Mail::queue($view, $data, function($message) 
			use ($fromEmail, $fromName, $subject, $to){
				$message->from($fromEmail->getEmail(), $fromName)
					->subject($subject)
					->to($to->getEmail());
		});
	}

	/* 
	 * Validate given parameters
	 *
	 * @param $view
	 * @param $subject
	 * @param $fromName
	 */
	public function validateParameters($view, $subject, $fromName)
	{
		if (empty($view) && empty($subject) && empty($fromName))
			throw new InvalidParameterException('Mailer parameters should not be empty');

		return true;
	}

}
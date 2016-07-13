<?php

namespace HackerspaceCRM\Mailers;

use Mail;
use App\Models\EmailTemplate;
use HackerspaceCRM\Mailers\EmailAddress;

abstract class Mailer
{

	/* 
	 * Deliver email with View template
	 *
	 * @param $view
	 * @param $subject
	 * @param $fromName
	 * @param HackerspaceCRM\Mailers\EmailAddress $fromEmail
	 * @param HackerspaceCRM\Mailers\EmailAddress $to
	 * @param $data
	 */
	public function deliverView($view, $subject, $fromName, EmailAddress $fromEmail, EmailAddress $to, array $data = array())
	{
		$this->validateParameters([$view, $subject, $fromName]);

		return Mail::queue($view, $data, function($message) 
			use ($fromEmail, $fromName, $subject, $to){
				$message->from($fromEmail->getEmail(), $fromName)
					->subject($subject)
					->to($to->getEmail());
		});
	}

	/* 
	 * Deliver email with View template
	 *
	 * @param $view
	 * @param $subject
	 * @param $fromName
	 * @param HackerspaceCRM\Mailers\EmailAddress $fromEmail
	 * @param HackerspaceCRM\Mailers\EmailAddress $to
	 * @param $data
	 */
	public function deliverDB(EmailTemplate $template, $fromName, EmailAddress $fromEmail, EmailAddress $to, array $data = array())
	{
		$this->validateParameters($fromName);

		return Mail::queue([], [], function($message) 
			use ($template, $fromEmail, $fromName, $to, $data){
				$message->from($fromEmail->getEmail(), $fromName)
					->subject($template->email_subject)
					->to($to->getEmail())
					->setBody($template->bladeCompile($data), 'text/html');
		});
	}

	/* 
	 * Validate given parameters
	 *
	 * @param $parameter
	 */
	public function validateParameters($parameter)
	{
		if (is_array($parameter)) {
			foreach ($parameter as $param) {
				$this->validateParameters($param);
			}
		}

		if (empty($parameter))
			throw new InvalidParameterException('Mailer parameters should not be empty');

	}

}
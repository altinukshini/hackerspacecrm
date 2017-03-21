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
	 * @param HackerspaceCRM\Mailers\EmailAddress $toEmail
	 * @param $data
	 */
    public function deliverView($view, $subject, $fromName, EmailAddress $fromEmail, EmailAddress $toEmail, array $data = [])
    {
        $this->validateParameters([$view, $subject, $fromName]);

        return Mail::queue($view, $data, function ($message)
 use ($fromEmail, $fromName, $subject, $toEmail) {
                $message->from($fromEmail->getEmail(), $fromName)
                    ->subject($subject)
                    ->to($toEmail->getEmail());
        });
    }

    /*
	 * Deliver email with View template
	 *
	 * @param $view
	 * @param $subject
	 * @param $fromName
	 * @param HackerspaceCRM\Mailers\EmailAddress $fromEmail
	 * @param HackerspaceCRM\Mailers\EmailAddress $toEmail
	 * @param $data
	 */
    public function deliverDB(EmailTemplate $template, $fromName, EmailAddress $fromEmail, EmailAddress $toEmail, array $data = [])
    {
        $this->validateParameters($fromName);

        return Mail::queue([], [], function ($message)
 use ($template, $fromEmail, $fromName, $toEmail, $data) {
                $message->from($fromEmail->getEmail(), $fromName)
                    ->subject($template->email_subject)
                    ->to($toEmail->getEmail())
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

        if (empty($parameter)) {
            throw new InvalidParameterException('Mailer parameters should not be empty');
        }
    }
}

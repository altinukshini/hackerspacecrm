<?php

namespace App\Models;

use Illuminate\Session\Store;

class FlashNotifier 
{

	/**
     * Illuminate\Session\Store
     *
     * @var
     */
	private $session;

	public function __construct(Store $session)
	{
		$this->session = $session;
	}

	/**
     * Flash success message
     *
     * @param $message String
     * @param $dismissable Boolean
     * @return void
     */
	public function success($message, $dismissable = true)
	{
		$this->message($message, 'success', $dismissable);
	}

	/**
     * Flash error message
     *
     * @param $message String
     * @param $dismissable Boolean
     * @return void
     */
	public function error($message, $dismissable = true)
	{
		$this->message($message, 'danger', $dismissable);
	}

	/**
     * Flash info message
     *
     * @param $message String
     * @param $dismissable Boolean
     * @return void
     */
	public function info($message, $dismissable = true)
	{
		$this->message($message, 'info', $dismissable);
	}

	/**
     * Flash warning message
     *
     * @param $message String
     * @param $dismissable Boolean
     * @return void
     */
	public function warning($message, $dismissable = true)
	{
		$this->message($message, 'warning', $dismissable);
	}

	/**
     * Flash message of type
     *
     * @param $message String
     * @param $type String
     * @param $dismissable Boolean
     * @return void
     */
	public function message($message, $type = 'info', $dismissable = false)
	{
		$this->session->flash('status', $message);
        $this->session->flash('status-type', $type);
        $this->session->flash('status-dismissable', $dismissable);
	}
}
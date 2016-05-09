<?php

namespace HackerspaceCRM\Flasher;

use Illuminate\Session\Store;

class FlashNotifier
{
    /**
     * Illuminate\Session\Store.
     *
     * @var
     */
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Flash success message.
     *
     * @param $message String
     * @param $dismissable Boolean
     */
    public function success($message, $dismissable = true)
    {
        $this->message($message, 'success', $dismissable);
    }

    /**
     * Flash error message.
     *
     * @param $message String
     * @param $dismissable Boolean
     */
    public function error($message, $dismissable = true)
    {
        $this->message($message, 'danger', $dismissable);
    }

    /**
     * Flash info message.
     *
     * @param $message String
     * @param $dismissable Boolean
     */
    public function info($message, $dismissable = true)
    {
        $this->message($message, 'info', $dismissable);
    }

    /**
     * Flash warning message.
     *
     * @param $message String
     * @param $dismissable Boolean
     */
    public function warning($message, $dismissable = true)
    {
        $this->message($message, 'warning', $dismissable);
    }

    /**
     * Flash message of type.
     *
     * @param $message String
     * @param $type String
     * @param $dismissable Boolean
     */
    public function message($message, $type = 'info', $dismissable = false)
    {
        $this->session->flash('status', $message);
        $this->session->flash('status-type', $type);
        $this->session->flash('status-dismissable', $dismissable);
    }
}

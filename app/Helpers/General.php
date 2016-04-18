<?php

if (!function_exists('flashMessage')) {

    /**
     * Flash message to session.
     *
     * @param Session message, message type (danger, info, warning, success), dismissable (boolean)
     * @return void
     */
    function flashMessage($message, $type = 'success', $dismissable = false)
    {
        Session::flash('status', $message);
        Session::flash('status-type', $type);
        Session::flash('status-dismissable', $dismissable);
    }
}
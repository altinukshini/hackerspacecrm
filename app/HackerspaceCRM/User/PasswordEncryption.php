<?php

namespace HackerspaceCRM\User;

class PasswordEncryption
{

    private $plainPassword;

    /**
     * @param $plainPassword
     */
    public function __construct($plainPassword)
    {

        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return bcrypt($this->plainPassword);
    }
}

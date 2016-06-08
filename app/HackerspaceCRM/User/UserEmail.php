<?php

namespace HackerspaceCRM\User;

use Doctrine\Instantiator\Exception\InvalidArgumentException;

class UserEmail {

    private $email;

    /**
     * @param $email
     */
    public function __construct($email){

        $this->setEmail($email);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException("Invalid E-mail Provided");
        }
        $this->email = $email;
    }


} 
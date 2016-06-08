<?php

namespace HackerspaceCRM\User;


class UserRegistrationDTO {

    protected $name;
    protected $email;
    protected $password;

    /**
     * @param $name
     * @param UserEmail $email
     * @param PasswordEncryption $password
     */
    public function __construct($name,UserEmail $email,PasswordEncryption $password){

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email->getEmail();
    }

    /**
     * @return PasswordEncryption
     */
    public function getPassword()
    {
        return $this->password->getPassword();
    }
} 
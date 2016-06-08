<?php

namespace HackerspaceCRM\User;


class UserLogInDTO {

    /**
     * @var UserEmail
     */

    private $email;
    private $password;

    public function __construct(UserEmail $email, $password){

        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return UserEmail
     */
    public function getEmail()
    {
        return $this->email->getEmail();
    }

    /**
     * Since Laravel will encrypt the password using it's Domain Service Auth we will use the plain password instead of Password Encryption
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

} 
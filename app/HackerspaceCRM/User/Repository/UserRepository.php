<?php

namespace HackerspaceCRM\User\Repository;

use HackerspaceCRM\User\User;
use HackerspaceCRM\User\UserRegistrationDTO;


class UserRepository implements UserRepositoryInterface{

    /**
     * @param UserRegistrationDTO $user
     * @return User
     */
    public function saveUser(UserRegistrationDTO $user)
    {
        $newUser = new User();

        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->password = $user->getPassword();

        $newUser->save();

        return $newUser;
    }
}
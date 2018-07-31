<?php

namespace HackerspaceCRM\User\Repository;

use HackerspaceCRM\User\UserRegistrationDTO;

interface UserRepositoryInterface
{
    public function saveUser(UserRegistrationDTO $user);
}

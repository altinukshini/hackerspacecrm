<?php

namespace HackerspaceCRM\User;

use Illuminate\Support\Facades\App;
use HackerspaceCRM\User\Repository\UserRepositoryInterface;

class UserRegistrationService
{

    /**
     * @var UserRegistrationDTO
     */
    private $userRegistrationDTO;

    /**
     * @param UserRegistrationDTO $userRegistrationDTO
     */
    public function __construct(UserRegistrationDTO $userRegistrationDTO)
    {

        $this->userRegistrationDTO = $userRegistrationDTO;
    }

    /**
     * @return App/Umbrella/User/User
     */
    public function register()
    {

        $userRepository = App::make(UserRepositoryInterface::class);
        $newUser = $userRepository->saveUser($this->userRegistrationDTO);

        return $newUser;
    }
}

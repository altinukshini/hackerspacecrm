<?php

namespace HackerspaceCRM\User;

use Illuminate\Support\Facades\Auth;

class UserLoginService
{

    /**
     * @var UserLogInDTO
     */
    private $userLoginDTO;

    public function __construct(UserLogInDTO $userLoginDTO)
    {

        $this->userLoginDTO = $userLoginDTO;
    }

    /**
     * @return mixed
     */
    public function login()
    {

        //user Laravel built in Auth
        return Auth::attempt(['email' => $this->userLoginDTO->getEmail() , 'password' => $this->userLoginDTO->getPassword()]);
    }
}

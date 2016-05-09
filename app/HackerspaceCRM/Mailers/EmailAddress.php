<?php 

namespace HackerspaceCRM\Mailers;

use Doctrine\Instantiator\Exception\InvalidArgumentException;

class EmailAddress {

    /**
     * @var
     */
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
     * @thorws InvalidArgumentException
     */
    public function setEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException("Invalid E-mail Provided");
        }
        $this->email = $email;
    }
} 
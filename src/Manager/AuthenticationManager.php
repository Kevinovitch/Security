<?php

namespace App\Manager;

use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthenticationManager implements AuthenticationManagerInterface
{

    public function authenticate(TokenInterface $token)
    {
        // TODO: Implement authenticate() method.
    }
}
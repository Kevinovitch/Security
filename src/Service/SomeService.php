<?php

namespace App\Service;

use Symfony\Component\Security\Core\Authentication\Token\SwitchUserToken;
use Symfony\Component\Security\Core\Security;

class SomeService
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function someMethod()
    {
        // ...

        $token = $this->security->getToken();

        if ($token instanceof SwitchUserToken) {
            $impersonatorUser = $token->getOriginalToken()->getUser();
        }

        // ...
    }
}
<?php

namespace App\Encoder;

use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class FoobarEncoder extends BasePasswordEncoder
{

    public function encodePassword(string $raw, ?string $salt)
    {

        if ($this->isPasswordTooLong($raw)) {
            throw new BadCredentialsException('Invalid password');
        }

        // ...

    }

    public function isPasswordValid(string $encoded, string $raw, ?string $salt)
    {
        if($this->isPasswordTooLong($raw)){
            return false;
        }

        // ....
    }

}
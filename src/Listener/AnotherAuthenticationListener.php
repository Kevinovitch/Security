<?php

namespace App\Listener;

use App\Entity\User;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\User\InMemoryUserProvider;
use Symfony\Component\Security\Core\User\UserChecker;

class AnotherAuthenticationListener
{

    public  function __invoke(RequestEvent $event)
    {
        $request = $event->getRequest();

        $userProvider = new InMemoryUserProvider(
            [
                'admin' => [
                    // password is "foo"
                    'password' => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg==',
                    'roles' => ['ROLE_ADMIN'],
                ]
            ]
        );

        // for some extra checks: is account enabled, locked, expired, etc.
        $userChecker = new UserChecker();

        // an array of password encoders (see below)
        $defaultEncoder = new MessageDigestPasswordEncoder('sha512', true, 5000);
        $weakEncoder = new MessageDigestPasswordEncoder('md5', true, 1);

        $encoders = [
            User::class       => $defaultEncoder,
            LegacyUser::class => $weakEncoder,
            // ...
        ];

        $encoderFactory = new EncoderFactory($encoders);

        $daoProvider = new DaoAuthenticationProvider(
            $userProvider,
            $userChecker,
            'secured_area',
            $encoderFactory
        );

        $daoProvider->authenticate($unauthenticatedToken);
    }

}
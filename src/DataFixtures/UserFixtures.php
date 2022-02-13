<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setEmail('bonjour@hotmail.fr');

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'salut'
        ));

        $user->setRoles(array('ROLE_USER'));

        $manager->persist($user);
        $manager->flush();
    }
}

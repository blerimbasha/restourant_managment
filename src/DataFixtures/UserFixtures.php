<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('admin');
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,'123456'
        ));
        $user->setNumber(044000000);
        $user->setRole(['ROLE_SUPER_ADMIN']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setName('admin');
        $user->setUsername('user');
        $user->setEmail('user@user.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,'123456'
        ));
        $user->setNumber(044000000);
        $user->setRole(['ROLE_USER']);
        $manager->persist($user);
        $manager->flush();
    }
}

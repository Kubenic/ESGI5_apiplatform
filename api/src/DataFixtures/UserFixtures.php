<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1
            ->setEmail('aevrard@gmail.com')
            ->setPassword($this->encoder->encodePassword($user1, 'toto_1234'));
        $manager->persist($user1);

        $user2 = new User();
        $user2
            ->setEmail('jordan.venant@gmail.com')
            ->setPassword($this->encoder->encodePassword($user2, 'pass_1234'));
        $manager->persist($user2);

        $manager->flush();
    }
}

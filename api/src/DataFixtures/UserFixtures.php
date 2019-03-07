<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail('aevrard@gmail.com');
        $user1->setPassword('toto1234');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('jordan.venant@gmail.com');
        $user2->setPassword('baby-foot');
        $manager->persist($user2);

        $manager->flush();
    }
}

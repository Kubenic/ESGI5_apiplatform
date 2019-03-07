<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Seat;

class SeatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $seat = new Seat();
        $seat->setName('A01');
        $seat->setStatus(1);
        $manager->persist($seat);

        $manager->flush();
    }
}

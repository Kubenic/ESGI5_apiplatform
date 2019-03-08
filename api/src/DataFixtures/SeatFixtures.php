<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Seat;

class SeatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        for ($i = 0; $i < 25; $i++) {
            $seat = new Seat();
            $seat->setName('A' . $i);
            $seat->setStatus(0);
            $manager->persist($seat);
        }
        for ($i = 0; $i < 25; $i++) {
            $seat = new Seat();
            $seat->setName('B' . $i);
            $seat->setStatus(0);
            $manager->persist($seat);
        }

        $manager->flush();
    }
}

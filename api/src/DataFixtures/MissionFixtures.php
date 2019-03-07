<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Mission;

class MissionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*
        $mission = new Mission();
        $mission->setStartDate(new \DateTime());
        $mission->setEndDate(new \DateTime());
        $manager->persist($mission);
        */

        $manager->flush();
    }
}

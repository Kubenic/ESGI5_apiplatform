<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Pilot;

class PilotFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $pilot = new Pilot();
        $pilot->setName('Henry');
        $pilot->setPhone('0606068888');
        $pilot->setGrade('Caporal');
        $manager->persist($pilot);

        $manager->flush();
    }
}

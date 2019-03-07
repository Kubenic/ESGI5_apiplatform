<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Airport;

class AirportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $airport = new Airport();
        $airport->setName('Charles De Gaulle');
        $airport->setAcronym('CDG');
        $airport->setCountry('France');
        $airport->setCity('Roissy');
        $manager->persist($airport);

        $manager->flush();
    }
}

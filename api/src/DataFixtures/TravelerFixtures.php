<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Traveler;

class TravelerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $traveler = new Traveler();
        $traveler->setFirstname('Traveler1');
        $traveler->setLastname('Flyer');
        $traveler->setPhone('0608080808');
        $traveler->setEmail('traveler1@gmail.com');
        $traveler->setPassword('travelertest');
        $traveler->setStatus('1');
        $manager->persist($traveler);

        $manager->flush();
    }
}

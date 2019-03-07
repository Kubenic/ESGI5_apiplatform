<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Luggage;

class LuggageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $luggage = new Luggage();
        $luggage->setWeight('50');
        $manager->persist($luggage);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Pilot;
use Faker\Factory;

class PilotFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $pilot = new Pilot();
            $pilot
                ->setName($faker->lastName)
                ->setPhone($faker->mobileNumber)
                ->setGrade($faker->colorName);
            $manager->persist($pilot);
        }

        $manager->flush();
    }
}

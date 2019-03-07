<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Airport;
use Faker\Factory;

class AirportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $airport = new Airport();
        $airport
            ->setName('Charles De Gaulle')
            ->setAcronym('CDG')
            ->setCountry('France')
            ->setCity('Roissy');
        $manager->persist($airport);

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 4; $i++) {
            $airport = new Airport();
            $airport
                ->setName($faker->name)
                ->setCountry($faker->departmentName)
                ->setAcronym($faker->departmentNumber)
                ->setCity($faker->departmentNumber);
            $manager->persist($airport);
        }

        $manager->flush();
    }
}

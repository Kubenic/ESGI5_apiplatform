<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Traveler;
use Faker\Factory;

class TravelerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $traveler = new Traveler();
            $traveler
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPhone($faker->mobileNumber)
                ->setEmail($faker->email)
                ->setPassword('passwordaencodeplustard')
                ->setStatus('1');
            $manager->persist($traveler);
        }
        $manager->flush();
    }
}

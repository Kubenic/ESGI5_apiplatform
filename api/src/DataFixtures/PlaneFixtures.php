<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Pilot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Plane;
use Faker\Factory;

class PlaneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pilots = $manager->getRepository(Pilot::class)->findAll();
        $companies = $manager->getRepository(Company::class)->findAll();

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $plane = new Plane();
            $plane->setName($faker->vat);
            $plane->setCapacity('500');
            $plane->setPilot($pilots[$i]);
            $plane->setCompany($companies[$i]);
            $manager->persist($plane);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            PilotFixtures::class,
            CompanyFixtures::class,
        );
    }
}

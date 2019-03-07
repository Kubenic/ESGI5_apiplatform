<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Company;
use Faker\Factory;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $company1 = new Company();
        $company1->setName('Air France');
        $manager->persist($company1);

        $company2 = new Company();
        $company2->setName('Air Corsica');
        $manager->persist($company2);

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 3; $i++) {
            $company = new Company();
            $company->setName($faker->company);
            $manager->persist($company);
        }

        $manager->flush();
    }
}

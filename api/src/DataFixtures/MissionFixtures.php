<?php

namespace App\DataFixtures;

use App\Entity\Airport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Mission;

class MissionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $location = $manager->getRepository(Airport::class)->findAll();

        $mission = new Mission();
        $mission
            ->setStartDate(new \DateTime())
            ->setEndDate(new \DateTime())
            ->setStartLocation($location[0])
            ->setEndLocation($location[0])
            ->setStartTerminal('A1')
            ->setEndTerminal('A2');
        $manager->persist($mission);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AirportFixtures::class,
        );
    }

}

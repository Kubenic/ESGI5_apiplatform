<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use App\Entity\Seat;
use App\Entity\Traveler;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Ticket;

class TicketFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $missions = $manager->getRepository(Mission::class)->findAll();
        $seats = $manager->getRepository(Seat::class)->findAll();
        $travelers = $manager->getRepository(Traveler::class)->findAll();

        $ticket = new Ticket();
        $ticket->setPrice('40')
            ->setMission($missions[0])
            ->setSeat($seats[0])
            ->setTraveler($travelers[0]);
        $manager->persist($ticket);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            MissionFixtures::class,
            SeatFixtures::class,
            TravelerFixtures::class,
        );
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Luggage;

class LuggageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tickets = $manager->getRepository(Ticket::class)->findAll();

        $luggage = new Luggage();
        $luggage->setWeight('50')->setTicket($tickets[0]);
        $manager->persist($luggage);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TicketFixtures::class,
        );
    }
}

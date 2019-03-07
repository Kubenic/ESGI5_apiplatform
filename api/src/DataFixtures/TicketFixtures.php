<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Ticket;

class TicketFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*
        $ticket = new Ticket();
        $ticket->setPrice('40');
        $manager->persist($ticket);
        */
        $manager->flush();
    }
}

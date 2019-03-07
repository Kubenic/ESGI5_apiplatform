<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Plane;

class PlaneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $plane = new Plane();
        $plane->setName('BX0123');
        $plane->setCapacity('500');
        $manager->persist($plane);

        $manager->flush();
    }
}

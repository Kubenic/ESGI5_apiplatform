<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Offer;

class OfferFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $offer = new Offer();
        $offer->setNumberReduction('50');
        $offer->setCumulable('1');
        $offer->setTypeReduction('Enfant');
        $manager->persist($offer);

        $manager->flush();
    }
}

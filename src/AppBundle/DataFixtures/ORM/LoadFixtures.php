<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFixtures implements FixtureInterface
{
public function load(ObjectManager $manager)
{

    for($i=0;$i<100000;$i++) {
        $genus = new Product();
        $genus->setName($i.'Octopus' . rand(1, 10000));
        $genus->setDescription($i.'Octopodinae');
        $genus->setPrice($i.rand(100, 99999));
        $manager->persist($genus);
    }
        $manager->flush();
}
}

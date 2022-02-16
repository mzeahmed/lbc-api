<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('FR-fr');

        $ad = new Ad();

        $manager->flush();
    }
}

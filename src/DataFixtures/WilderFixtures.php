<?php

namespace App\DataFixtures;

use App\Entity\Wilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class WilderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 11; $i++) {
            $wilder = new Wilder();
            $wilder->setFirstname($faker->firstName);
            $wilder->setLastname($faker->lastName);
            $wilder->setBirthDate($faker->dateTime);
            $wilder->setInformations($faker->realText(100));
            $manager->persist($wilder);
        }
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Workshop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class WorkshopFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1;$i <= 50; $i++) {
            $workshop = new Workshop();
            $workshop->setUser($this->getReference('user_' . $i));
            $workshop->setAddress($this->getReference('address_' . $i));
            $workshop->setName($faker->word);
            $workshop->setDescription($faker->text);
            $workshop->setPicture($faker->word);
            $workshop->setUserMax(10);
            $workshop->setUserRegistered(0);
            $workshop->setDateTime($faker->dateTime);

            $manager->persist($workshop);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [UserFixtures::class];
    }
}

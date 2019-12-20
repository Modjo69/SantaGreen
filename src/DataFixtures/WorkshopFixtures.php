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
        $j=1;
        for ($i = 1; $i <= 40; $i++) {
            $workshop = new Workshop();
            $workshop->setUser($this->getReference('user_' . $i));
            $workshop->setAddress($this->getReference('address_' . random_int(1,5)));
            $workshop->setName($faker->word);
            $workshop->setDescription($faker->text);
            $workshop->setPicture('/images/workshop/workshop-' . $j . '.jpg');
            $workshop->setUserMax(10);
            $workshop->setUserRegistered(0);
            $workshop->setDateTime($faker->dateTime);
            $workshop->setCategory($this->getReference('categorie_'.random_int(1,4)));
            $j++;
            if ($j===20){
                $j=1;
            }
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

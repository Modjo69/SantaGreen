<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AddressFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1;$i <= 50; $i++) {
            $address = new Address();
            $address->setStreet($faker->streetAddress);
            $address->setPostalCode($faker->postcode);
            $address->setCity($faker->city);
            $address->setCountry($faker->country);
            $address->setUser($this->getReference('user_' . $i));
            $this->addReference('address_' . $i, $address);

            $manager->persist($address);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [UserFixtures::class];
    }
}

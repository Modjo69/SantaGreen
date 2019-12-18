<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
class CategoryFixtures extends Fixture
{
    const CATEGORY=['enfants', 'grands-parents', 'parents', 'familiale'];

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        $i=1;
      foreach( self::CATEGORY as $categorie){
          $category=new Category();
          $category->setName($categorie);
          $category->setPicture($faker->imageUrl());
          $category->setDescription($faker->realText());
          $this->addReference('categorie_' . $i, $category);
          $i++;
          $manager->persist($category);
      }

        $manager->flush();
    }
}

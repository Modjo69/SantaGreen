<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $j=1;
        for ($i = 1;$i <= 40; $i++) {
            $article= new Article();
            $article->setUser($this->getReference('user_'.$i));
            $article->setCategory($this->getReference('categorie_'.random_int(1,4)));
            $article->setName($faker->domainName);
            $article->setDescription($faker->text);

            $article->setPicture('/images/articles/article'.$j.'.jpeg');
            $manager->persist($article);
            $j++;
            if ($j===20){
                $j=1;
            }
        }


        $manager->flush();
    }
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [CategoryFixtures::class];
    }

}

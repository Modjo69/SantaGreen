<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    const Article =[
        'images/articles/articles1.jpeg',
        'images/articles/articles2.jpeg'

    ];
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1;$i <= 50; $i++) {
            $article= new Article();
            $article->setUser($this->getReference('user_'.$i));
            $article->setCategory($this->getReference('categorie_'.random_int(1,4)));
            $article->setName($faker->domainName);
            $article->setDescription($faker->text);
            $article->setPicture(array_rand(self::Article));
            $manager->persist($article);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [CategoryFixtures::class];
    }

}

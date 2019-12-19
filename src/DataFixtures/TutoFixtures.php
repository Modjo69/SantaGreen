<?php

namespace App\DataFixtures;

use App\Entity\Tuto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TutoFixtures extends Fixture
{
    public const TUTO = [
        0 => [
        'name' => 'Un sapin avec des branches naturelles',
        'description' => 'Pour cet arbre de Noël, il vous faudra d\'abord faire un tour en forêt pour ramasser quelques branches. Accrochez-les ensuite les unes aux autres à l\'aide d\'une jolie corde fine.',
        'link' => 'https://ueberallunirgendwo.blogspot.com/2012/12/pamk-weihnachtsbaum-to-go.html',
        'picture' => '/images/sapin.jpg'
        ],
        1 => [
            'name' => 'DIY faire un sapin en bois de palette - Stéphanie bricole',
            'description' => 'Maintenant les palettes sont démontées, place au sapin ! (le vrai est déjà fait depuis lundi) Un grand classique pour les bricoleuses...',
            'link' => 'http://www.stephaniebricole.com/archives/2014/12/03/31074019.html',
            'picture' => '/images/sapin_palette.jpg'
        ],
        2 => [
            'name' => 'Sapin en Bois écologique',
            'description' => ' SAPIN DE NOËL DÉCORATIF FAIT RECYCLÉ MEUBLES EN BOIS FAITS MAIN NOËL NATUREL IDÉAL POUR RESPECTUEUX DE L’ENVIRONNEMENT. L’ARBRE SE COMPOSE DE LAMELLES EN BOIS INDIVIDUELS ',
            'link' => 'https://www.etsy.com/fr/listing/655547643/bois-ecologique?gpla=1&gao=1&&utm_source=google&utm_medium=cpc&utm_campaign=shopping_fr_fr_fr_a-home_and_living-other&utm_custom1=d86eb937-54bf-440d-bc82-856f2a720bd2&utm_content=go_304709059',
            'picture' => '/images/sapin_planche.jpg'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TUTO as $tutos => $item) {
            $tuto = new Tuto();
            $tuto->setName($item['name']);
            $tuto->setDescription($item['description']);
            $tuto->setLink($item['link']);
            $tuto->setPicture($item['picture']);
            $tuto->setUser($this->getReference('user_'.random_int(1,50)));
            $tuto->setCategory($this->getReference('categorie_'. random_int(1,4)));
            $manager->persist($tuto);
        }
        $manager->flush();
    }
}

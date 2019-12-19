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
        3 => [
            'name' => 'Cloche décorative',
            'description' => 'Sublimez votre déco de Noël, ainsi que vos tables de fête, avec de belles cloches décoratives.
Dans un même kit, vous pouvez retrouver tout le matériel nécessaire pour réaliser 2 cloches déco. Elles contiennent un beau décor de Noël. De quoi faire son petit effet à l\'occasion des fêtes de fin d\'année !
Découvrez les quelques étapes à suivre, pour monter vos cloches décoratives, et décorez votre intérieur en toute facilité !  ',
            'link' => 'https://www.creavea.com/noel_diy-cloche-deco-de-noel_fiches-conseils_6593-0.html',
            'picture' => '/images/cloche.jpg'
        ],
        4 => [
            'name' => 'Centre de table',
            'description' => 'Reproduisez ce magnifique centre de table, à l\'occasion de Noël et des fêtes de fin d\'année, et épatez vos convives !
Dans ce tuto vidéo, apprenez à transformer un simple plateau en un bel objet déco. Et cela en toute facilité !
Ne vous limitez pas à notre liste de matériel suggéré pour ce DIY centre de table de Noël : décorez-le à votre goût en disposant, sur votre plateau, les décorations et embellissement de votre choix. Effet garanti ! ',
            'link' => 'https://www.creavea.com/noel_diy-video-centre-de-table-de-noel_fiches-conseils_6592-0.html',
            'picture' => '/images/centre.jpg'
        ],
        5 => [
            'name' => 'Cloche décorative',
            'description' => 'Sublimez votre déco de Noël, ainsi que vos tables de fête, avec de belles cloches décoratives.
Dans un même kit, vous pouvez retrouver tout le matériel nécessaire pour réaliser 2 cloches déco. Elles contiennent un beau décor de Noël. De quoi faire son petit effet à l\'occasion des fêtes de fin d\'année !
Découvrez les quelques étapes à suivre, pour monter vos cloches décoratives, et décorez votre intérieur en toute facilité !  ',
            'link' => 'https://www.creavea.com/noel_diy-cloche-deco-de-noel_fiches-conseils_6593-0.html',
            'picture' => '/images/cloche.jpg'
        ],
        6 => [
            'name' => 'DIY Star Wars : princesse Leïa en feutrine',
            'description' => 'Découvrez comment réaliser une mini poupée en feutrine, réalisable dès 9-10 ans ! Très facile à créer, suivez chacune des étapes proposées par Crealoutre pour apprendre à faire votre poupée Leïa ! Bonne création :) ',
            'link' => 'https://www.creavea.com/diy-star-wars_diy-star-wars-princesse-leia-en-feutrine_fiches-conseils_5046-0.html',
            'picture' => '/images/5046.jpg'
        ],
        7 => [
            'name' => 'Un sapin avec des branches naturelles',
            'description' => 'Pour cet arbre de Noël, il vous faudra d\'abord faire un tour en forêt pour ramasser quelques branches. Accrochez-les ensuite les unes aux autres à l\'aide d\'une jolie corde fine.',
            'link' => 'https://ueberallunirgendwo.blogspot.com/2012/12/pamk-weihnachtsbaum-to-go.html',
            'picture' => '/images/sapin.jpg'
        ],
        8 => [
            'name' => 'la terrine de foie gras maison',
            'description' => 'Noël arrive, il est temps d\'épater vos convives... Pour cela, réalisez votre terrine de foie gras maison grâce à ce pas-à-pas facile ! ',
            'link' => 'https://www.maxi-mag.fr/recettes/etape-6.html#slideshow-1',
            'picture' => '/images/etape1.jpg'
        ],
        9 => [
            'name' => 'DIY Noël enfant',
            'description' => 'Détournez une assiette en carton pour fabriquer une tête de père Noël à accrocher. Les enfants pourront utiliser cette suspension pour décorer l’école ou la maison !
Proposez cette activité originale à un ou plusieurs enfants et amusez-vous tous ensemble.
Cette activité ne coûte pas plus de deux euros par enfant ! ',
            'link' => 'https://www.creavea.com/noel_diy-noel-suspension-pere-noel-kawaii_fiches-conseils_6577-0.html',
            'picture' => '/images/suspension.jpg'
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

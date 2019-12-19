<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Workshop;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tuto;

class HomeController extends AbstractController

{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/home", name="home.index")
     */
    public function index()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        $articles=$this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        $workshops=$this->getDoctrine()
            ->getRepository(Workshop::class)
            ->findAll();
        $tutos=$this->getDoctrine()
            ->getRepository(Tuto::class)
            ->findAll();





        return $this->render('home/index.html.twig', [
            'categories'=>$categories,
            'articles'=>$articles,
            'workshops'=>$workshops,
            'tutos'=>$tutos
        ]);
    }

}

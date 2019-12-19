<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController

{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/home", name="home.index")
     */
    public function index()
    {
        $categorys = new Category();
        $categorys = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();


        return $this->render('home/index.html.twig', [
            'categorys'=>$categorys
        ]);
    }

}

<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\SearchCategoryType;
use App\Entity\SearchCategory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(Request $request)
    {
        $articles= $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        $formSearch= $this-> createForm(SearchCategoryType::class);
        $formSearch->handleRequest($request);
        if ($formSearch->isSubmitted()){
            $articles= $this->getDoctrine()
                ->getRepository(Article::class)
                ->findBy(['category'=>$formSearch->get('category')->getData()]);
        }
        return $this->render('article/index.html.twig', [
            'formSearch' => $formSearch->createView(),
            'articles'=>$articles
        ]);
    }
}

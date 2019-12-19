<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Tuto;
use App\Form\SearchCategoryType;
use App\Form\TutoType;
use App\Repository\TutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TutoController extends AbstractController
{
    /**
     * @Route("/tuto", name="tuto", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tutos = $this->getDoctrine()
            ->getRepository(Tuto::class)
            ->findAll();
        $formSearch= $this-> createForm(SearchCategoryType::class);
        $formSearch->handleRequest($request);
        if ($formSearch->isSubmitted()){
            $tutos= $this->getDoctrine()
                ->getRepository(Tuto::class)
                ->findBy(['category'=>$formSearch->get('category')->getData()]);
        }
        return $this->render('tuto/index.html.twig', [
            'tutos' => $tutos,
            'formSearch'=>$formSearch->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Workshop;
use App\Form\SearchCategoryType;
use App\Form\WorkshopType;
use App\Repository\WorkshopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/workshop")
 */
class WorkshopController extends AbstractController
{
    /**
     * @Route("/", name="workshop_index", methods={"GET", "POST"})
     */
    public function index(WorkshopRepository $workshopRepository, Request $request): Response
    {

        $workshops= $this->getDoctrine()
            ->getRepository(Workshop::class)
            ->findAll();
        $formSearch= $this-> createForm(SearchCategoryType::class);
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted()){

            $workshops= $this->getDoctrine()
                ->getRepository(Workshop::class)
                ->findBy(['category'=>$formSearch->get('category')->getData()]);
        }
        return $this->render('workshop/index.html.twig', [
            'formSearch'=>$formSearch->createView(),
            'workshops' => $workshops,
        ]);
    }

    /**
     * @Route("/{id}", name="workshop_show", methods={"GET"})
     */
    public function show(Workshop $workshop): Response
    {
        return $this->render('workshop/show.html.twig', [
            'workshop' => $workshop,
        ]);
    }
}

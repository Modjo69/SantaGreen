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
     * @Route("/new", name="workshop_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $workshop = new Workshop();
        $form = $this->createForm(WorkshopType::class, $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workshop);
            $entityManager->flush();

            return $this->redirectToRoute('workshop_index');
        }

        return $this->render('workshop/new.html.twig', [
            'workshop' => $workshop,
            'form' => $form->createView(),
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

    /**
     * @Route("/{id}/edit", name="workshop_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Workshop $workshop): Response
    {
        $form = $this->createForm(WorkshopType::class, $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_index');
        }

        return $this->render('workshop/edit.html.twig', [
            'workshop' => $workshop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="workshop_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Workshop $workshop): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workshop->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workshop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('workshop_index');
    }
}

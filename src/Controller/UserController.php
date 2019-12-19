<?php

namespace App\Controller;

use App\Entity\Tuto;
use App\Form\TutoType;
use App\Repository\TutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/user", name="user_index")
 */

class UserController extends AbstractController
{
    /**
     * @Route("/tuto/", name="user")
     */
    public function index(?UserInterface $user)
    {
        $userId = $user->getId();
        $tutos = $this->getDoctrine()
            ->getManager()
            ->findBy($userId);

        return $this->render('user/index.html.twig', [
            'tutos' => $tutos,
        ]);
    }

    /**
     * @Route("/tuto/new", name="tuto_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $tuto = new Tuto();
        $form = $this->createForm(TutoType::class, $tuto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tuto);
            $entityManager->flush();

            return $this->redirectToRoute('tuto');
        }

        return $this->render('tuto/new.html.twig', [
            'tuto' => $tuto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tuto/{id}", name="tuto_show", methods={"GET"})
     * @param Tuto $tuto
     * @return Response
     */
    public function show(Tuto $tuto): Response
    {
        return $this->render('tuto/show.html.twig', [
            'tuto' => $tuto,
        ]);
    }

    /**
     * @Route("/tuto/{id}/edit", name="tuto_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Tuto $tuto
     * @return Response
     */
    public function edit(Request $request, Tuto $tuto): Response
    {
        $form = $this->createForm(TutoType::class, $tuto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tuto');
        }

        return $this->render('tuto/edit.html.twig', [
            'tuto' => $tuto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tuto/{id}", name="tuto_delete", methods={"DELETE"})
     * @param Request $request
     * @param Tuto $tuto
     * @return Response
     */
    public function delete(Request $request, Tuto $tuto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tuto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tuto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tuto');
    }
}

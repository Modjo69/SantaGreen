<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Article;
use App\Entity\Tuto;
use App\Entity\User;
use App\Entity\Workshop;
use App\Form\AddressType;
use App\Form\ArticleType;
use App\Form\SearchCategoryType;
use App\Form\TutoType;
use App\Form\UserType;
use App\Form\WorkshopType;
use App\Repository\TutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/account", name="user_index")
 */

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_account")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function indexUser(Request $request,  ?UserPasswordEncoderInterface $encoder, ?UserInterface $user)
    {
        $userOnline = $user;
        $form = $this->createForm(UserType::class, $userOnline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($userOnline, $userOnline->getPassword());
            $user->setPassword($encoded);
            $userOnline = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($userOnline);
            $em->flush();
        }

        $address = new Address();
        $address->setUser($user);
        $formAddress = $this->createForm(AddressType::class, $address);
        $formAddress->handleRequest($request);

        if ($formAddress->isSubmitted() && $formAddress->isValid()) {
            $address = $formAddress->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
        }

        return $this->render('user/user_index.html.twig', [
            'form' => $form->createView(),
            'formAddress' => $formAddress->createView(),
        ]);
    }

    /**
     * @Route("/tuto/", name="tuto_index")
     * @param UserInterface|null $user
     * @return Response
     */
    public function indexTuto(?UserInterface $user)
    {
        $userId = $user->getId();
        $tutos = $this->getDoctrine()
            ->getRepository(Tuto::class)
            ->findBy(
                ['user' => $userId]
            );

        return $this->render('user/tuto_index.html.twig', [
            'tutos' => $tutos,
        ]);
    }

    /**
     * @Route("/tuto/new", name="tuto_new", methods={"GET","POST"})
     * @param Request $request
     * @param UserInterface|null $user
     * @return Response
     */
    public function newTuto(Request $request, ?UserInterface $user): Response
    {
        $tuto = new Tuto();
        $tuto->setUser($user);
        $form = $this->createForm(TutoType::class, $tuto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tuto);
            $entityManager->flush();

            return $this->redirectToRoute('tuto_index');
        }

        return $this->render('user/tuto_new.html.twig', [
            'tuto' => $tuto,
        ]);
    }

    /**
     * @Route("/tuto/{id}", name="tuto_show", methods={"GET"})
     * @param Tuto $tuto
     * @return Response
     */
    public function showTuto(Tuto $tuto): Response
    {
        if (empty($user)) {
            return $this->redirectToRoute('home.index');
        }

        return $this->render('tuto/tuto_show.html.twig', [
            'tuto' => $tuto,
        ]);
    }

    /**
     * @Route("/tuto/{id}/edit", name="tuto_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Tuto $tuto
     * @return Response
     */
    public function editTuto(Request $request, Tuto $tuto): Response
    {
        if (empty($user)) {
            return $this->redirectToRoute('home.index');
        }

        $form = $this->createForm(TutoType::class, $tuto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tuto');
        }

        return $this->render('tuto/tuto_edit.html.twig', [
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
    public function deleteTuto(Request $request, Tuto $tuto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tuto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tuto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tuto');
    }


//ARTICLE SECTION

    /**
     * @Route("/article/", name="article_index")
     * @param Request $request
     * @param UserInterface|null $user
     * @return RedirectResponse|Response
     */
    public function indexArticle(Request $request, ?UserInterface $user)
    {
        $userId = $user->getId();
        $articles = $this->getDoctrine()
            ->getRepository(Tuto::class)
            ->findBy(
                ['user' => $userId]
            );

        return $this->render('user/article_index.html.twig', [
            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/article/new", name="article_new", methods={"GET","POST"})
     * @param Request $request
     * @param UserInterface|null $user
     * @return Response
     */
    public function newArticle(Request $request, ?UserInterface $user): Response
    {
        $article = new article();
        $article->setUser($user);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('user/article_new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show", methods={"GET"})
     * @param Article $article
     * @return Response
     */
    public function showArticle(article $article): Response
    {
        return $this->render('user/article_show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/article/{id}/edit", name="article_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function editArticle(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/tuto_edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/delete/{id}", name="article_delete", methods={"DELETE"})
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function deleteArticle(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }


    //WORKSHOP SECTION


    /**
     * @Route("/workshop/", name="workshop")
     * @param Request $request
     * @param UserInterface|null $user
     * @return RedirectResponse|Response
     */
    public function indexWorkshop(Request $request, ?UserInterface $user)
    {

        $userId = $user->getId();
        $workshops = $this->getDoctrine()
            ->getRepository(Workshop::class)
            ->findBy(
                ['user' => $userId]
            );

        return $this->render('user/workshop_index.html.twig', [
            'workshops' => $workshops,
        ]);
    }


    /**
     * @Route("/worshop/new", name="workshop_new", methods={"GET","POST"})
     * @param Request $request
     * @param UserInterface|null $user
     * @return Response
     */
    public function newWorkshop(Request $request, ?UserInterface $user): Response
    {
        $workshop = new Workshop();
        $workshop->setUser($user);
        $form = $this->createForm(WorkshopType::class, $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workshop);
            $entityManager->flush();

            return $this->redirectToRoute('workshop_index');
        }

        return $this->render('user/workshop_new.html.twig', [
            'workshop' => $workshop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/workshop/{id}", name="workshop_show", methods={"GET"})
     * @param Workshop $workshop
     * @return Response
     */
    public function showWorkshop(Workshop $workshop): Response
    {
        return $this->render('user/workshop_show.html.twig', [
            'workshop' => $workshop,
        ]);
    }

    /**
     * @Route("/workshop/{id}/edit", name="workshop_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Workshop $workshop
     * @return Response
     */
    public function editWorkshop(Request $request, Workshop $workshop): Response
    {
        $form = $this->createForm(WorkshopType::class, $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workshop_index');
        }

        return $this->render('user/workshop_edit.html.twig', [
            'workshop' => $workshop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/workshop/{id}", name="workshop_delete", methods={"DELETE"})
     * @param Request $request
     * @param Workshop $workshop
     * @return Response
     */
    public function deleteWorkshop(Request $request, Workshop $workshop): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workshop->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workshop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('workshop_index');
    }
}

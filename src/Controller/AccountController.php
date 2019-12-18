<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Article;
use App\Entity\User;
use App\Entity\Workshop;
use App\Form\AddressType;
use App\Form\ArticleType;
use App\Form\UserType;
use App\Form\WorkshopType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function index(Request $request,  UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        $address = new Address();
        $address->setUser($user->getId());
        $formAddress = $this->createForm(AddressType::class, $address);
        $formAddress->handleRequest($request);

        if ($formAddress->isSubmitted() && $formAddress->isValid()) {
            $address = $formAddress->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
        }

        $article = new Article();
        $formArticle = $this->createForm(ArticleType::class, $article);
        $formArticle->handleRequest($request);

        if ($formArticle->isSubmitted() && $formArticle->isValid()) {
            $article = $formArticle->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }

        $workshop = new Workshop();
        $formWorkshop = $this->createForm(WorkshopType::class, $workshop);
        $formWorkshop->handleRequest($request);

        if ($formWorkshop->isSubmitted() && $formWorkshop->isValid()) {
            $workshop = $formWorkshop->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($workshop);
            $em->flush();
        }


        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
            'formAddress' => $formAddress->createView(),
            'formArticle' => $formArticle->createView(),
            'formWorkshop' => $formWorkshop->createView(),
        ]);
    }
}

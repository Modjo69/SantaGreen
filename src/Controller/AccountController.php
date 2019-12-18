<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Form\AddressType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
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

        if ($form->isSubmitted() && $form->isValid()) {
            $address = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
        }


        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
            'formAddress' => $formAddress->createView(),
        ]);
    }
}

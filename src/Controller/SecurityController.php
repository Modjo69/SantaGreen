<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home.index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        //last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $newUser = new User();
        $form = $this->createForm(UserType::class, $newUser, [
            'action' => $this->generateUrl('app_register')
        ]);

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername,
            'error' => $error, 'form' => $form->createView(),]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $newUser = new User();
        $newUser->setPicture('null');
        $newUser->setDescription('null');
        $form = $this->createForm(UserType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($newUser, $newUser->getPassword());
            $newUser->setPassword($encoded);
            $newUser->setPicture('/images/renne.jpg');
            $newUser->setDescription('Vive Santa Green!');
            $newUser = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($newUser);
            $em->flush();
            return $this->redirectToRoute('home.index');
        }

        return $this->redirectToRoute('app_login');
    }
}

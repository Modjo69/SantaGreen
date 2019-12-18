<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WorkshopController extends AbstractController
{
    /**
     * @Route("/workshop", name="workshop")
     */
    public function index()
    {


        return $this->render('workshop/index.html.twig', [
            'controller_name' => 'WorkshopController',
        ]);
    }

}

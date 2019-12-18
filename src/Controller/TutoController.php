<?php

namespace App\Controller;

use App\Repository\TutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TutoController extends AbstractController
{
    /**
     * @Route("/tuto", name="tuto")
     * @param TutoRepository $tutos
     * @return Response
     */
    public function index(TutoRepository $tutos)
    {
        return $this->render('tuto/index.html.twig', [
            'tutos' => $tutos->FindAll(),
        ]);
    }
}

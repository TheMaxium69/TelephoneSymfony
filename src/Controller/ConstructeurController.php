<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConstructeurController extends AbstractController
{
    /**
     * @Route("/constructeur", name="constructeur")
     */
    public function index(): Response
    {
        return $this->render('constructeur/index.html.twig', [
            'controller_name' => 'ConstructeurController',
        ]);
    }
}

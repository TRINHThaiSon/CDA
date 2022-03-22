<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Connecter1Controller extends AbstractController
{
    /**
     * @Route("/connecter1", name="connecter1")
     */
    public function index(): Response
    {
        return $this->render('connecter1/se_connecter.html.twig', [
            'controller_name' => 'Connecter1Controller',
        ]);
    }
    
}

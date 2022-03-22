<?php

namespace App\Controller;

use App\Entity\SousCategories;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(CategoriesRepository $repo): Response
    {
        #dump($repo->findAll());
        return $this->render('accueil/accueil.html.twig', [
            'accueilListe' => $repo->findAll(),
        ]);
        
    }

   /**
     * @Route("/home", name="homepage")
     */
    public function indexhome(CategoriesRepository $repo): Response
    {
        
        return $this->render('accueil/home.html.twig', [
            'accueilListe' => $repo->findAll(),
        ]);
        
    }

    
    
}

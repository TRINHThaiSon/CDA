<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SouscatesController extends AbstractController
{
    /**
     * @Route("/souscates/{id}", name="souscates")
     */
    public function souscates(Categories $id): Response
    {
        // $liste = $repo->findBy(['categorie'=>$id]);
        return $this->render('souscates/index.html.twig', [
            'categorie' => $id,
        ]);
    }
    /**
     * @Route("/souscatesfront/{id}", name="souscatesfront")
     */
    public function souscatesfront(Categories $id): Response
    {
        // $liste = $repo->findBy(['categorie'=>$id]);
        return $this->render('souscates/souscate.html.twig', [
            'categorie' => $id,
        ]);
    }
    
}

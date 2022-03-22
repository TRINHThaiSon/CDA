<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\InscriptionType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscrireController extends AbstractController
{
    /**
     * @Route("/inscrire", name="inscrire")
     */
    public function index(Request $request): Response
    {
        $client = new Clients();
        
        $form = $this->createForm(InscriptionType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //$manager->persist($client);
            //$manager->flush();
       }
        return $this->render('inscrire/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\SousCategories;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use App\Repository\SousCategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/produits/{id}", name="produits")
     */
    public function produits(SousCategories $id): Response
    {
        // $produitliste = $repo->findBy(['souscategorie'=>$id]);
        return $this->render('produits/produits.html.twig', [
            'sousCategorie' => $id,
        ]);
    }
    /**
     * @Route("/produitsfront/{id}", name="produitsfront")
     */
    public function produitsfront(SousCategories $id): Response
    {
        // $produitliste = $repo->findBy(['souscategorie'=>$id]);
        return $this->render('produits/produitsfront.html.twig', [
            'sousCategorie' => $id,
        ]);
    }
    /**
     * @Route("/details/{id}", name="details")
     */
    public function detail(Produits $id): Response
    {
        // $produitliste1 = $repo1->find($id);
        return $this->render('produits/details.html.twig', [
            'produit' => $id,
        ]);
    }
    /**
     * @Route("/newproduit", name="newproduit")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class,$produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($produit);
            $entityManager->flush();
            
            return $this->redirectToRoute("produitsfront", [
                "id" => $produit->getSouscategorie()->getId()
            ]);
        }
        return $this->render('produits/ajoutproduit.html.twig', [
            'produitform' => $form->createView(),
        ]);    
        
    }
    /**
     * @Route("/editproduit/{id}", name="editproduit")
     */
    public function edit(Request $request, Produits $produit,EntityManagerInterface $entityManager ): Response
    {
        
        $form = $this->createForm(ProduitsType::class,$produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($produit);
            $entityManager->flush();
            
            return $this->redirectToRoute("produitsfront", [
                "id" => $produit->getSouscategorie()->getId()
            ]);
        }
        return $this->render('produits/editproduit.html.twig', [
            'produitform' => $form->createView(),
        ]);    
        
    }
    /**
     * @Route("/removeproduit/{id}", name="removeproduit")
     */
    public function remov(Request $request, Produits $produit,EntityManagerInterface $entityManager ): Response
    {
        
        $form = $this->createForm(ProduitsType::class,$produit);
        $form->handleRequest($request);
        $entityManager->remove($produit);
        $entityManager->flush();
        
            
        return $this->redirectToRoute("produitsfront", [
                "id" => $produit->getSouscategorie()->getId()
            ]);
        
       
        
    }
}

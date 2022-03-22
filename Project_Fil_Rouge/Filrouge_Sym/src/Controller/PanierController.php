<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository): Response
    {
        $panier = $session->get("panier",[]);
        // On fabrique les données
        $dataPanier = [];
        $total = 0;
        foreach($panier as $id => $quantite){
            $product = $produitsRepository->find($id);
            $dataPanier[]=[
                "produit" => $product,
                "quantite" => $quantite
            ];
            $total += $product->getPrixunitArticle()*$quantite;
        }
        return $this->render('panier/mon_panier.html.twig', compact("dataPanier","total"));
       
    }
    /**
     * @Route("/ajouter/{id}", name="ajouter")
     */
    public function add(Produits $produit, SessionInterface $session): Response
    {
        // On récupère la panier actuel
        $panier = $session->get("panier",[]);
        $id = $produit->getId();
        if(!empty($panier[$id]))
        {
            $panier[$id]++;
        }
        else 
        {
           $panier[$id]=1;
        }
        //On sauvegarde dans la session
        $session->set("panier", $panier);
        //dd($session);
        
        return $this->redirectToRoute("panier");
    }
    /**
     * @Route("/retirer/{id}", name="retirer")
     */
    public function remove(Produits $produit, SessionInterface $session): Response
    {
        // On récupère la panier actuel
        $panier = $session->get("panier",[]);
        $id = $produit->getId();
        if(!empty($panier[$id])){
            if($panier[$id]>1){
                $panier[$id]--;
            }
            else{
                unset($panier[$id]);
            }
        }
        //On sauvegarde dans la session
        $session->set("panier", $panier);
        //dd($session);
        
        return $this->redirectToRoute("panier");
        }
    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function delete(Produits $produit, SessionInterface $session): Response
    {
        // On récupère la panier actuel
        $panier = $session->get("panier",[]);
        $id = $produit->getId();
        if(!empty($panier[$id])){
            
                unset($panier[$id]);
            }
        
        //On sauvegarde dans la session
        $session->set("panier", $panier);
        //dd($session);
        
        return $this->redirectToRoute("panier");
        }
    /**
     * @Route("/supprimer", name="tous_supprime")
     */
    public function deleteAll(SessionInterface $session): Response
    {
        
        $session->set("panier", []);
        //dd($session);
        
        return $this->redirectToRoute("panier");
        
       

    }    
}

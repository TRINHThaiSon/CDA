<?php

namespace App\Controller;


use App\Entity\User;
use DateTimeInterface;
use App\Entity\Clients;
use App\Entity\Commandes;
use App\Form\CommandesType;
use App\Entity\LigneCommande;
use Doctrine\ORM\EntityManager;
use App\Repository\ClientsRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandesController extends AbstractController
{
    /**
     * @Route("/commandes", name="commandes")
     */
    public function index(): Response
    {   $form = $this->createForm(CommandesType::class);
    

        return $this->render('commandes/commande.html.twig', [
            'commform' => $form->createView(),
        ]);
    }
    /**
     * @Route("/validecommande", name="validecommande")
     */
    public function validecommande(SessionInterface $session, ProduitsRepository $produitsRepository, ClientsRepository $cli_repo, EntityManagerInterface $em, Request $request): Response
    {   
        $commande= new Commandes();
        
        $form = $this->createForm(CommandesType::class,$commande);
        $panier = $session->get("panier",[]);
        $user = $this->getUser();
        $client = $cli_repo->findOneByUser($user);

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

        $form->get("nomClient")->setData($client->getNomClient());
        $form->get("prenomClient")->setData($client->getPrenomClient());
        $form->get("dateComm")->setData(new \DateTime());
        $form->get("adressLivr")->setData($client->getAdressClient());
        $form->get("cpLivr")->setData($client->getcpClient());
        $form->get("villeLivr")->setData($client->getvilleClient());
        $form->get("adressFact")->setData($client->getAdressClient());
        $form->get("cpFact")->setData($client->getcpClient());
        $form->get("villeFact")->setData($client->getvilleClient());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $commande->setDateComm(new \DateTime);
            $commande->setMontantComm($total);
            $commande->setTauxTva(0.1);
            $commande->setClient($client);
           
            foreach($panier as $id =>$quantite){
                $ligncomm= new LigneCommande();
                $product = $produitsRepository->find($id);
                $ligncomm->setCommande($commande);
                $ligncomm->setProduit($product);
                $ligncomm->setQuantite($quantite);
                $ligncomm->setPrixUnitaire($product->getPrixunitArticle());
                $em->persist($ligncomm);
            }
            
            $em->persist($commande);
            
            $em->flush();    
    
            
            return $this->redirectToRoute("accueil");
                
            
        }

        return $this->render('commandes/commande.html.twig', [
            'commform' => $form->createView(),
            "dataPanier" => $dataPanier,
            "total" => $total,
            "user" => $user,
            "client" => $client,
        ]);
            
        
    }
}

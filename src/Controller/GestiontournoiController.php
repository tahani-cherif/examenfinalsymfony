<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PartieRepository;
use App\Repository\JoueurRepository; 
use App\Form\JoueurType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Joueur;

class GestiontournoiController extends AbstractController
{
    #[Route('/list', name: 'app_list')]
    public function list(PartieRepository $PartieRepository): Response
    {    $partie=$PartieRepository->findAll();
        return $this->render('gestiontournoi/index.html.twig', [ 'partie'=>$partie ]);
    }
    #[Route('/list/{id}', name: 'app_detail')]
    public function listbyid( $id,PartieRepository $PartieRepository): Response
    {    $partie=$PartieRepository->find($id);
        return $this->render('gestiontournoi/detail.html.twig', [ 'partie'=>$partie ]);
    }
    #[Route('/listjour', name: 'app_list_jour')]
    public function listjoueur(JoueurRepository $JoueurRepository): Response
    {    $joueur=$JoueurRepository->findAll();
        return $this->render('gestiontournoi/listjoueur.html.twig', [ 'joueur'=>$joueur ]);
    }
    #[Route('/listjourordonner', name: 'app_list_jourordonner')]
    public function listjourordonner(JoueurRepository $JoueurRepository): Response
    {   
         $order = $JoueurRepository->getOrderbyScore();
        return $this->render('gestiontournoi/listjoueur.html.twig', [ 'joueur'=>$order ]);
    }
    #[Route('/add', name: 'app_add')]
    public function add(JoueurRepository $JoueurRepository,Request $request): Response
    {   $joueur=new Joueur();
        $form=$this->createForm(JoueurType::class,$joueur);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $JoueurRepository->save($joueur,true);
            return $this->redirectToRoute('app_list_jour'); 
        }
        return $this->renderForm('gestiontournoi/ajouterjoueur.html.twig', ['formadd'=>$form ]); 
    }
    #[Route('/update/{id}', name: 'app_update')]
    public function update(JoueurRepository $JoueurRepository,Request $request,$id): Response
    {   $joueur=$JoueurRepository->find($id);
        $form=$this->createForm(JoueurType::class,$joueur);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $JoueurRepository->save($joueur,true);
            return $this->redirectToRoute('app_list_jour'); 
        }
        return $this->renderForm('gestiontournoi/ajouterjoueur.html.twig', ['formadd'=>$form ]); 
    }
    #[Route('/listjourbycountpartie', name: 'app_list_joueurcountbypartie')]
    public function listjoueurcountbypartie(JoueurRepository $JoueurRepository): Response
    {   
         $order = $JoueurRepository->countbypartie();
        //  var_dump($order) . die();
        return $this->render('gestiontournoi/joueurcount.html.twig', [ 'joueur'=>$order ]);
    }
    #[Route('/listjoueurbypartie/{id}', name: 'app_list_jourbypartie')]
    public function listjoueurbypartie(JoueurRepository $JoueurRepository, PartieRepository $PartieRepository, $id): Response
    {
        $partie = $PartieRepository->find($id);
        $joueur = $JoueurRepository->getJourByPartie($id);
        return $this->render('gestiontournoi/listejourbypartie.html.twig', [
            'partie' => $partie,
            'joueur' => $joueur
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use App\Entity\Voiture;
use App\Form\ChauffeurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChauffeurController extends AbstractController
{
    /**
     * @Route("/chauffeur", name="chauffeur")
     */
    public function index(): Response
    {
        return $this->render('chauffeur/index.html.twig', [
            'controller_name' => 'ChauffeurController',
        ]);
    }
    /**
     * @Route("/listChauffeur", name="listChauffeur")
     */
    public function listChauffeur(){
        $chauffeurs=$this->getDoctrine()->getRepository(Chauffeur::class)->findAll();
        return$this->render('chauffeur/listChauffeur.html.twig',array('tabChauffeur'=>$chauffeurs));
    }
    /**
     * @Route("/ajouterChauffeur/{id}", name="ajouterChauffeur")
     */
    public function ajouterChauffeur(Request $request,$id)
    {
        $chauffeur = new Chauffeur();
        $voiture=$this->getDoctrine()->getRepository(Voiture::class)->find($id);
        $form = $this->createForm(ChauffeurType::class,$chauffeur);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chauffeur);
            $em->flush();
            return $this->redirectToRoute('listVoiture');
        }
        return $this->render('chauffeur/ajouterChauffeur.html.twig',array('voiture'=>$voiture,'addChauffeur'=>$form->createView()));
    }
    /**
     * @Route("/updateChauffeur/{id}", name="updateChauffeur")
     */
    public function updateChauffeur(Request $request,$id){
        $chauffeur=$this->getDoctrine()->getRepository(Chauffeur::class)->find($id);
        $form = $this->createForm(ChauffeurType::class,$chauffeur);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listChauffeur');
        }
        return $this->render('chauffeur/updateChauffeur.html.twig',array('updateChauffeur'=>$form->createView()));
    }
}

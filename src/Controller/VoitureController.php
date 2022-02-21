<?php

namespace App\Controller;

use App\Entity\Voiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/voiture", name="voiture")
     */
    public function index(): Response
    {
        return $this->render('voiture/index.html.twig', [
            'controller_name' => 'VoitureController',
        ]);
    }
    /**
     * @Route("/listVoiture", name="listVoiture")
     */
    public function listVoiture(){
        $voitures=$this->getDoctrine()->getRepository(Voiture::class)->findAll();
        return$this->render('voiture/listVoiture.html.twig',array('tabVoiture'=>$voitures));
    }
    /**
     * @Route("/deleteVoiture/{id}", name="deleteVoiture")
     */
    public function deleteVoiture($id){
        $voiture=$this->getDoctrine()->getRepository(Voiture::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($voiture);
        $em->flush();
        return$this->redirectToRoute('listVoiture');
    }
    /**
     * @Route("/countVoiture/{marque}", name="countVoiture")
     */
    public function countVoiture($marque){
        $voitures=$this->getDoctrine()->getRepository(Voiture::class)->findAll();
        $count=$this->getDoctrine()->getRepository(Voiture::class)->searchVoiture($marque);
        return$this->render('voiture/listVoiture.html.twig',array('count'=>$count,'tabVoiture'=>$voitures,'marque'=>$marque));
        //return new Response('le nombre de voiture est:'.$count);



}}

<?php

namespace App\Controller;

use App\Entity\AnneeScolaire;
use App\Form\AnneeScolaireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnneeScolaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnneeScolaireController extends AbstractController
{

    /**
     * @Route("RP/annee", name="annee_scolaire_show")
     */
    

    public function index(AnneeScolaireRepository $repo,Request $request,EntityManagerInterface $em): Response
    {
        $anneeScolaires=$repo->findAll();
        $anneeScolaire= new AnneeScolaire();
        $form= $this->createForm(AnneeScolaireType::class,$anneeScolaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $anneeScolaire->setIsStatus(0);
            $em->persist($anneeScolaire);
            $em->flush();
            return $this->redirectToRoute('annee_scolaire_show');
        }
        

        return $this->render('annee_scolaire/index.html.twig', ['anneeScolaires'=>$anneeScolaires,'form'=>$form->createView()]);
    }

    /**
     * @Route("RP/annee", name="annee_scolaire_show")
     */
    

    public function sho(AnneeScolaireRepository $repo,Request $request,EntityManagerInterface $em): Response
    {
        $anneeScolaires=$repo->findAll();
        $anneeScolaire= new AnneeScolaire();
        $form= $this->createForm(AnneeScolaireType::class,$anneeScolaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $anneeScolaire->setIsStatus(0);
            $em->persist($anneeScolaire);
            $em->flush();
            return $this->redirectToRoute('annee_scolaire_show');
        }
        

        return $this->render('annee_scolaire/index.html.twig', ['anneeScolaires'=>$anneeScolaires,'form'=>$form->createView()]);
    }

     /**
     * @Route("rp/edit/anneeScolaire/{id}", name="annee_scolaire_edit",methods={"GET","POST"})
     */
    public function edit(AnneeScolaire $anneeScolaire,AnneeScolaireRepository $repo,Request $request,EntityManagerInterface $em): Response
    {
        $anneeScolaires=$repo->findAll();
        $form= $form= $this->createForm(AnneeScolaireType::class,$anneeScolaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($anneeScolaire);
            $em->flush();
            return $this->redirectToRoute('annee_scolaire_show');
        }
             return $this->render('annee_scolaire/index.html.twig', ['anneeScolaires'=>$anneeScolaires,'form'=>$form->createView()]);
    }
}

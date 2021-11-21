<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnneeScolaireController extends AbstractController
{
    /**
     * @Route("RP/annee", name="annee_scolaire_show")
     */
    public function index(): Response
    {
        return $this->render('annee_scolaire/index.html.twig', [
            'controller_name' => 'AnneeScolaireController',
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GatoController extends AbstractController
{
    /**
     * @Route("gato/statistiques", name="statistiques")
     */
    public function statistiques(ClasseRepository $classeRepo): Response
    {
        $classes = $classeRepo->findAll();
        return $this->render('gato/index.html.twig',["classes"=> $classes]);
    }
}

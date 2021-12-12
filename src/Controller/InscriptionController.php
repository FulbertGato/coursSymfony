<?php

namespace App\Controller;

use App\Service\DigitalGenerator;
use App\Repository\ClasseRepository;
use App\Repository\InscriptionRepository;
use App\Repository\AnneeScolaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    /**
     * @Route("ac/inscriptions", name="inscriptions")
     */
        
        public function index(InscriptionRepository $repoInscri, AnneeScolaireRepository $repoAnne,ClasseRepository $classeRepo,SessionInterface $session): Response
    {
        if($session->has("idAnnee")){
            $idAnnee=(int)$session->get('idAnnee');
            $anneeEncours =$repoAnne->find($idAnnee);
            $session->remove('idAnnee');
        }else{
            $anneeEncours =$repoAnne->findOneBy(
                [ 'isStatus'=>1]
             );
        }
       $classes= $classeRepo->findAll();
        
        $inscriptions = $repoInscri->findBy(
            ['anneeScolaire'=>$anneeEncours]
        );
        return $this->render('inscription/index.html.twig', [
            'inscriptions' => $inscriptions ,
            'classes' => $classes
        ]);
    }

    /**
     * @Route("ac/inscriptions/annee", name="inscription_annee")
     */
    public function showInscriptionByAnne(InscriptionRepository $repoIns,Request $request,SessionInterface $session){

        if ($request->isXmlHttpRequest()) {
            $id=$request->query->get('id');
            $session->set("idAnnee",$id);
            $this->changeAnneeScolaireEncoursInSession($session,$id);
        }


        return new JsonResponse($this->generateUrl('inscription_show'));

    }

    private function changeAnneeScolaireEncoursInSession($session, $idAnneeEnCours){

        $anneeInsession = $session->get('annees');
        foreach ($anneeInsession as $key => $annee) {
           if($annee->getId()==$idAnneeEnCours){

                $anneeInsession[$key]->setIsStatus(true);
           }else{
            $anneeInsession[$key]->setIsStatus(false);
           }
        }


    }
}

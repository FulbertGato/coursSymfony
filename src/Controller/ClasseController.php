<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    /**
     * @Route("rp/classe", name="classe_show")
     */
    public function index(EntityManagerInterface $em, ClasseRepository $classeRepo): Response
    {

        $classes = $classeRepo->findAll();
       // dd($classes);
        return $this->render('classe/index.html.twig', ["classes"=> $classes]);
    }


    /**
     *@Route("rp/classe/edit/{id}", name="classe_edit")
     */
    public function edit($id,ClasseRepository $classeRepo){
        $classeSelect= $classeRepo->find($id);
        $classes = $classeRepo->findAll();
      // dd($classeSelect);
       return $this->render('classe/index.html.twig', ["classes"=> $classes,"classeSelect"=>$classeSelect]);
    }

    /**
     * @Route("rp/classe/delete/{id}", name="classe_delete")
    */
    public function delete(Classe $classe,EntityManagerInterface $em){

        if(count($classe->getInscriptions())>0){
            $this->addFlash(
                'error_message',
                'Cette classe contient des inscriptions'
            );

        }else{
           // dd($classe);
            $em->remove($classe);
            $em->flush();
        }
        
        return $this->redirectToRoute('classe_show');

    }

    /**
     * @Route("rp/classe/save", name="classe_save",methods={"POST"})
     */
    public function save(Request $request,ClasseRepository $classeRepo,EntityManagerInterface $em){
       // dd($request);
      
       if($request->request->has('btn_save')){
           if(empty($request->request->get('libelle'))){

            $this->addFlash(
                'error_message',
                'Veuillez saissir un libelle'
            );
           }else{
               $classe=null;
               $id=$request->request->get('id');
               if(trim($id)=='0'){
                   $classe= new Classe;
                   
               }else{
                    $classe=$classeRepo->find($id);
               }
               $classe->setLibelle($request->request->get('libelle'));
               $em->persist($classe);
               $em->flush();
           }
       }
       return $this->redirectToRoute('classe_show');
    }
}

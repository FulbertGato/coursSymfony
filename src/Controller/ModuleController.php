<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    /**
     * @Route("rp/module", name="module_show",methods={"GET","POST"})
     */
    public function index(ModuleRepository $repo,Request $request,EntityManagerInterface $em,TranslatorInterface $translator): Response
    {
        dd($request->getPathInfo());
        $modules=$repo->findAll();
        $module= new Module();
        $form= $this->createForm(ModuleType::class,$module);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($module);
            $em->flush();
            return $this->redirectToRoute('module_show');
        }
        

        return $this->render('module/index.html.twig', ['modules'=>$modules,'form'=>$form->createView(), 'message'=>$translator->trans('module.blank')]);
    }

    /**
     * @Route("rp/edit/module/{id}", name="module_edit",methods={"GET","POST"})
     */
    public function edit(Module $module,ModuleRepository $repo,Request $request,EntityManagerInterface $em): Response
    {
        $modules=$repo->findAll();
        $form= $form= $this->createForm(ModuleType::class,$module);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($module);
            $em->flush();
            return $this->redirectToRoute('module_show');
        }
             return $this->render('module/index.html.twig', ['modules'=>$modules,'form'=>$form->createView()]);
    }

    /**
     * @Route("rp/delete/module/{id}", name="module_delete",methods={"GET"})
     */
    public function delete(Module $module,EntityManagerInterface $em)
    {
        if(count($module->getProfesseurs())>0){
            $this->addFlash(
                'error_message',
                'Cet module  contient des inscriptions' );

        }else{
           //dd($classe);
            $em->remove($module);
            $em->flush();
        }
        
        return $this->redirectToRoute('module_show');
    }

    /**
     * @Route("rp/save/module/", name="module_save",methods={"POST"})
     */
    public function save(): Response
    {
        return $this->render('module/index.html.twig', [ ]);
    }
}

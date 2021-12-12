<?php

namespace App\Form;

use App\Entity\AnneeScolaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnneeScolaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'

                ]
            ])
            ->add('Enregistrer',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-success mt-1'

                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnneeScolaire::class,
        ]);
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AnneeScolaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=2019; $i <2022 ; $i++) { 
            $data=new AnneeScolaire();
              $annee= $i."-".($i+1);
              $data->setLibelle($annee);
              if($i==2021){
                  $data->setIsStatus(true);

              }else {
                $data->setIsStatus(false);
              }   
            $this->addReference("AnneeScolaire".$i, $data); 
            $manager->persist($data);
            $manager->flush();
        
            
    }
}
}

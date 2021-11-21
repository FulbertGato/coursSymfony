<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        
        $classes=["L1MAE","L2MAE","L3MAE","L1GLRS","L2GLRS","L3GLRS","L1IAGE","L2IAGE","L3IAGE","L1TTL","L2TTL","L3TTL"];
        $i=1;
        foreach($classes as $libelle){
            
            $data = new Classe();
            $data->setLibelle($libelle);
            $this->addReference("Classe".$i, $data); 
            $i++;
            $manager->persist($data);
 
            
        }


        $manager->flush();
    }
}

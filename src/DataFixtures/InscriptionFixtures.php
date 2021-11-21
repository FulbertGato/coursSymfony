<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=40;$i++){
        $data = new Inscription();
        $randClasse = rand(1,5);
        $randAnneeScolaire = rand(2019,2021);
        $randEtudiant = rand(1,20);
       $data->setClasse( $this->getReference("Classe".$randClasse))
            ->setAnneeScolaire($this->getReference("AnneeScolaire".$randAnneeScolaire))
            ->setEtudiant($this->getReference("Etudiant".$randEtudiant));
       $this->addReference("Inscription".$i,$data);
       $manager->persist($data);
        }

        $manager->flush();
    }

    public function getDependencies(){

        return [
            AnneeScolaireFixtures::class,
            ClasseFixtures::class,
            EtudiantFixtures::class
        ];
     }
}

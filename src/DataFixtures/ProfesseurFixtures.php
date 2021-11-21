<?php

namespace App\DataFixtures;
use App\Entity\Module;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfesseurFixtures extends Fixture implements DependentFixtureInterface
{

    private $encoder;

    public function  __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        
        $grade=["MASTER","INGENIEUR","DOCTEUR"];
        
        for ($i = 1; $i <=11; $i++) {
            $data= new Professeur();
            $data->setNomComplet("Professeur".$i);
            $data->setNci(uniqid())
                 ->setEmail("professeur".$i."@gatojunior.co");
            $rand= rand(0,3);
            $randModule= rand(0,5);
            $data->setGrade($rand);
            $plainPassword = 'passer@123';
            $passwordEncode= $this->encoder->hashPassword($data, $plainPassword);
            $data->setPassword($passwordEncode);
            for ($j = 0; $j < $randModule; $j++) {

                $data->addModule($this->getReference("Module".$j));
            }
             
            $this->addReference("Professeur".$i, $data); 
            $manager->persist($data);
          
        }


        $manager->flush();
    }

 public function getDependencies(){

    return [
        ModuleFixtures::class
    ];
 }  
}

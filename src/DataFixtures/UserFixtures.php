<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function  __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $roles=["ROLE_RP","ROLE_AC"];
        
       /* for ($i = 1; $i <=10; $i++) {
            $user = new User();
            $pos= rand(0,2);
            $role=[$roles[$pos]];
            $user->setNomComplet('Nom et Prenom  '.$i);
            $user->setEmail(strtolower($role[0]).$i."@gatojunior.co");
            $encoded = $this->encoder->hashPassword($user, $plainPassword);
            $user->setPassword($encoded);
            $user->setRoles($role);
            $manager->persist($user);
           // $this->addReference("User".$i, $user);
        }*/

        foreach ($roles as $libelle) {
            $data= new User();
            $data->setNomComplet($libelle)
                 ->setEmail(strtolower($libelle)."@gatojunior.co")
                 ->setRoles([$libelle]);
            $plainPassword = 'passer@123';
            $passwordEncode= $this->encoder->hashPassword($data, $plainPassword);
            $data->setPassword($passwordEncode);
            $manager->persist($data);
        }
 
            $manager->flush();

    }
}

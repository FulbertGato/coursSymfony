<?php
namespace App\Service;

use Symfony\Component\Dotenv\Dotenv;




class DigitalGenerator{
    /**
     * Commence par le mot cle : MAT
     * Suivi de 5 chiffres
     * Exemple: MAT45712
     * @return string
     */
    public function generateMatricule(){

        $dotenv = new Dotenv();
        $last = getEnv('LASTMAT');
       
     


       // $lo=5;
       return uniqid();
    }

    /**
     * NCI
     *
     * @return string
     */
    public function generateNci():string{

        return uniqid();

    }
}
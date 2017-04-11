<?php

namespace DOJO\GameOfThronesBundle\Controller;

use DOJO\GameOfThronesBundle\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PersonnageController extends Controller
{

    public function showPersonnageAction($id = 1)
    {
        $em = $this->getDoctrine()->getManager();
        $personnage = $em->getRepository('DOJOGameOfThronesBundle:Personnage')
            ->findOneById($id);
        $personnage->getRoyaume()->getNom();
        var_dump($personnage->getRoyaume()->getNom());


    }

    public function addPersoAction($nom,$prenom,$sexe,$bio='')
    {
        $em = $this->getDoctrine()->getManager();
        $personnage = new Personnage();
        $personnage->setNom($nom);
        $personnage->setPrenom($prenom);
        $personnage->setSexe($sexe);
        $personnage->setBio($bio);
        $em->persist($personnage);
        $em->flush();
    }

}
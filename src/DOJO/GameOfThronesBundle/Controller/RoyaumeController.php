<?php

namespace DOJO\GameOfThronesBundle\Controller;

use DOJO\GameOfThronesBundle\Entity\Royaume;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RoyaumeController extends Controller
{
    public function addRoyaumeAction($nom, $capitale, $nbHabitant)
    {
        $em = $this->getDoctrine()->getManager();
        $royaume = new Royaume();
        $royaume->setNom($nom);
        $royaume->setCapitale($capitale);
        $royaume->setNbHabitant($nbHabitant);
        $em->persist($royaume);
        $em->flush();

        return $this->render('DOJOGameOfThronesBundle:Royaume:add_royaume.html.twig', array(
            'message'=> 'Royaume '.$royaume->getNom().' a été ajouté',
            'royaume'=> $royaume,
        ));
    }
    

}

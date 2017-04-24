<?php

namespace DOJO\GameOfThronesBundle\Controller;

use DOJO\GameOfThronesBundle\Entity\Personnage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Field\ChoiceFormField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


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

    public function addPersonnageAction($nom,$prenom,$sexe,$bio='')
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

    public function listPersonnageSexeAction($sexe)
    {
        $em = $this->getDoctrine()->getManager();
        $personnages=$em->getRepository('DOJOGameOfThronesBundle:Personnage')
            ->findBySexe($sexe);

        return $this->render('DOJOGameOfThronesBundle:Personnage:list_personnage.html.twig', array(
            'personnages'=> $personnages,
        ));
    }
    public function addAction(Request $request)
    {
        $perso = new Personnage();

        $formBuilder = $this->createFormBuilder($perso);
        $formBuilder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('sexe', TextType::class)
            ->add('bio', TextType::class)
            ->add('royaume', EntityType::class, array(
                'class' => 'DOJOGameOfThronesBundle:Royaume',
                'choice_label' => 'nom'))
            ->add('save', SubmitType::class);

        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($perso);
            $em->flush();
        }

        return $this->render('DOJOGameOfThronesBundle:Personnage:add.html.twig', array(
            'addPerso' => $form->createView(),
        ));

    }

}
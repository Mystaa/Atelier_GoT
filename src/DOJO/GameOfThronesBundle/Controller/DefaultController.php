<?php

namespace DOJO\GameOfThronesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DOJOGameOfThronesBundle:Default:index.html.twig');
    }

}

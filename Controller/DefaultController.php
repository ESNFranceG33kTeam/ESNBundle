<?php

namespace Esn\EsnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EsnEsnBundle:Default:index.html.twig');
    }
}

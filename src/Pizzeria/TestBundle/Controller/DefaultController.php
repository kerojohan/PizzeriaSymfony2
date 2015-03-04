<?php

namespace Pizzeria\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PizzeriaTestBundle:Default:index.html.twig');
    }
}

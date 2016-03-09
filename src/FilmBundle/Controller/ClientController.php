<?php

namespace FilmBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{
    public function clientAction()
    {
        return $this->render('FilmBundle:Default:client.html.twig');
    }
}


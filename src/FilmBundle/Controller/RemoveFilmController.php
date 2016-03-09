<?php

namespace FilmBundle\Controller;


use FilmBundle\Services\RemoveFilm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;

class RemoveFilmController extends Controller
{
    public function removeAction($id)
    {
        $removeFilm = $this->get('remove.film');

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        try {
            /** @var RemoveFilm $removeFilm */
            $removeFilm($id);
            $response->setContent('{"message":"OK"}');
        } catch (Exception $e) {
            $response->setContent('{"message":"Film doesn\'t exist"}');
        }

        return $response;
    }
}
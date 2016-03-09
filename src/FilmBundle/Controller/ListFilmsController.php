<?php

namespace FilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FilmBundle\Entity\Film;
use FilmBundle\Services\ListFilms;

class ListFilmsController extends Controller
{
    public function listAction(Request $request)
    {
        $listFilms = $this->get('list.films');
        $allFilms = $listFilms();
        $rows     = [];
        /** @var Film $film */
        foreach ($allFilms as $film) {
            $rows[] = [
                $film->getId(),
                $film->getName(),
                $film->getYear(),
                $film->getDate()->format('d/m/Y'),
                $film->getImdbUrl()
            ];
        }
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($rows));

        return $response;
    }
}


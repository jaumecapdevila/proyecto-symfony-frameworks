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
        /** @var ListFilms $listFilms */
        $listFilms = $this->get('list.films');
        /** @var ListFilms $listFilms */
        $allFilms = $listFilms();
        $rows     = [];
        /** @var Film $film */
        foreach ($allFilms as $film) {
            $rows[] = [
                "id" => $film->getId(),
                "name" => $film->getName(),
                "year" => $film->getYear(),
                "date" => $film->getDate()->format('d/m/Y'),
                "imdbUrl" => $film->getImdbUrl()
            ];
        }
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($rows));

        return $response;
    }
}


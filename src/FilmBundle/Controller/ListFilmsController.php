<?php

namespace FilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FilmBundle\Services\ListFilms;

class ListFilmsController extends Controller
{
    public function listAction(Request $request)
    {
        try {
            /** @var ListFilms $listFilms */
            $listFilms = $this->get('list.films');
            /** @var ListFilms $listFilms */
            $allFilms = $listFilms();
            $films = $this->get('create.film.list')->createFilmList($allFilms);
            $response = new JsonResponse($films);
            return $response;
        } catch (Exception $e) {
            return new JsonResponse([]);
        }
    }
}


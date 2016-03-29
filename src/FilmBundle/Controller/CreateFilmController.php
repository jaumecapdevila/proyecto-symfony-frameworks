<?php

namespace FilmBundle\Controller;

use FilmBundle\Services\CreateFilm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;

class CreateFilmController extends Controller
{
    public function createAction(Request $request)
    {
        $film = $this->get('create.film.from.request')->createNewFilmFromRequest($request);
        $response = new JsonResponse();
        $createFilm = $this->get('create.film');
        try {
            /** @var CreateFilm $createFilm */
            $createFilm($film);
            $filmId = $film->getId();
            $response->setContent('{"message":"Film created","id":'.$filmId.'}');
        } catch (Exception $e) {
            $response->setContent('{"message":"An error has ocurred while adding the new film"}');
        }
        return $response;
    }

}
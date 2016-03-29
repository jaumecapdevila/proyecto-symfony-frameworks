<?php

namespace FilmBundle\Controller;

use DateTime;
use FilmBundle\Entity\Command\CreateFilmCommand;
use FilmBundle\Services\CreateFilmUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;

class CreateFilmController extends Controller
{
    public function createAction(Request $request)
    {
        $response = new JsonResponse();
        $filmInfo  = json_decode($request->getContent(),true);
        $createFilmUseCase = $this->get('create.film');
        $createFilmCommand = new CreateFilmCommand(
            $filmInfo["name"],
            $filmInfo["year"],
            $filmInfo["date"],
            $filmInfo["url"]
        );
        try {
            /** @var CreateFilmUseCase $createFilmUseCase */
            $newFilm = $createFilmUseCase($createFilmCommand);
            $filmId = $newFilm->getId();
            $response->setContent('{"message":"Film created","id":'.$filmId.'}');
        } catch (Exception $e) {
            $response->setContent('{"message":"An error has ocurred while adding the new film"}');
        }
        return $response;
    }

}
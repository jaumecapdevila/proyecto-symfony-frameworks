<?php

namespace FilmBundle\Controller;


use FilmBundle\Entity\Command\RemoveFilmCommand;
use FilmBundle\Services\RemoveFilmUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;

class RemoveFilmController extends Controller
{
    public function removeAction($id)
    {
        /** @var RemoveFilmUseCase $removeFilm */
        $removeFilm = $this->get('remove.film');

        $response = new JsonResponse();

        try {
            $removeFilmCommand = new RemoveFilmCommand($id);
            $removeFilm($removeFilmCommand);
            $response->setContent('{"message":"OK"}');
        } catch (Exception $e) {
            $response->setContent('{"message":"Film doesn\'t exist"}');
        }

        return $response;
    }
}
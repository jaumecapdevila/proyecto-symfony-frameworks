<?php

namespace FilmBundle\Controller;

use FilmBundle\Entity\Command\EditFilmCommand;
use FilmBundle\Services\EditFilmUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;

class EditFilmController extends Controller
{
    public function editAction(Request $request, $id)
    {
        $filmInfo  = json_decode($request->getContent(),true);
        $editFilmCommand = new EditFilmCommand(
            $id,
            $filmInfo["name"],
            $filmInfo["year"],
            $filmInfo["date"],
            $filmInfo["url"]
        );

        /** @var EditFilmUseCase $editFilmUseCase */
        $editFilmUseCase = $this->get('edit.film');
        $response = new JsonResponse();

        try {
            $editFilmUseCase($editFilmCommand);
            $response->setContent('{"message":"Film edited"}');
        } catch (Exception $e) {
            $response->setContent('{"message":"An error has ocurred while editting the film"}');
        }

        return $response;
    }
}


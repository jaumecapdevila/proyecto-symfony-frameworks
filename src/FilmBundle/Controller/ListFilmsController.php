<?php

namespace FilmBundle\Controller;

use FilmBundle\Services\ListFilmsInArrayUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListFilmsController extends Controller
{
    public function listAction()
    {
        /** @var ListFilmsInArrayUseCase $listFilmsInArrayUseCase */
        $listFilmsInArrayUseCase = $this->get('list.films.array');
        $filmsList = $listFilmsInArrayUseCase();
        $response = new JsonResponse($filmsList);
        return $response;
    }
}


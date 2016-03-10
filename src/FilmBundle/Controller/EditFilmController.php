<?php

namespace FilmBundle\Controller;

use DateTime;
use FilmBundle\Services\EditFilm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FilmBundle\Entity\Film;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;

class EditFilmController extends Controller
{
    public function editAction(Request $request, $id)
    {
        $filmInfo = json_decode($request->getContent(), true);

        $date = DateTime::createFromFormat('d/m/Y', $filmInfo["date"]);
        $editedFilm = new Film($filmInfo["name"], $filmInfo["year"], $date, $filmInfo["url"]);
        $editedFilm->setId($id);
        $editFilm = $this->get('edit.film');

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        try {
            /** @var EditFilm $editFilm */
            $editFilm($editedFilm);
            $response->setContent('{"message":"Film edited"}');

        } catch (Exception $e) {
            $response->setContent('{"message":"An error has ocurred while editting the film"}');
        }

        return $response;
    }
}


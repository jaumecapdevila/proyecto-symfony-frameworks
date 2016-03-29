<?php

namespace FilmBundle\Controller;

use FilmBundle\Services\EditFilm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;

class EditFilmController extends Controller
{
    public function editAction(Request $request, $id)
    {
        $editedFilm = $this->get('create.film.from.request')->CreateNewFilmFromRequest($request);
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


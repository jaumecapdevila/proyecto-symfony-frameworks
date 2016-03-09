<?php

namespace FilmBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FilmBundle\Entity\Film;
use Symfony\Component\Config\Definition\Exception\Exception;

class CreateFilmController extends Controller
{
    public function createAction(Request $request)
    {
        $filmJson = '{"name":"Inglourious Basterds","year":2009,"date":"19/07/2009","url":"http://www.imdb.com/title/tt0361748/?ref_=fn_al_tt_1"}';
        $filmInfo  = json_decode($filmJson,true);

        $date = DateTime::createFromFormat('d/m/Y',$filmInfo["date"]);

        $film = new Film($filmInfo["name"],$filmInfo["year"],$date,$filmInfo["url"]);
        $createFilm = $this->get('create.film');

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        try {
            $createFilm($film);
            $filmId = $film->getId();
            $response->setContent('{"message":"Film created","id":'.$filmId.'}');
        } catch (Exception $e) {
            $response->setContent('{"message":"An error has ocurred while adding the new film"}');
        }

        return $response;
    }

}
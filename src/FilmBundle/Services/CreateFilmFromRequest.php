<?php

namespace FilmBundle\Services;
use DateTime;
use FilmBundle\Entity\Film;
use Symfony\Component\HttpFoundation\Request;

class CreateFilmFromRequest
{
    public function CreateNewFilmFromRequest(Request $request){
        $filmInfo  = json_decode($request->getContent(),true);
        $date = DateTime::createFromFormat('d/m/Y',$filmInfo["date"]);
        return new Film($filmInfo["name"],$filmInfo["year"],$date,$filmInfo["url"]);
    }
}

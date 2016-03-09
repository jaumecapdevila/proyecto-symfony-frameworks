<?php

namespace CacheBundle\Services;


use FilmBundle\Services\ListFilms;
use FilmBundle\Services\ListFilmsInterface;

class ListFilmsFromCache implements ListFilmsInterface
{
    private $listFilms;

    public function __construct(ListFilms $listFilms)
    {
        $this->listFilms = $listFilms;
    }

    public function __invoke()
    {
        if (file_exists(FilmsCacher::CACHE_FILE)) {
            $fileContents       = file_get_contents(FilmsCacher::CACHE_FILE);
            $serializedFilmList = explode("\n", $fileContents);
            $filmList           = [];
            foreach ($serializedFilmList as $serializedFilm) {
                $unserializedFilm = unserialize($serializedFilm);
                if ($unserializedFilm) {
                    $filmList[] = $unserializedFilm;
                }
            }
            return $filmList;
        }

        return call_user_func($this->listFilms);
    }
}


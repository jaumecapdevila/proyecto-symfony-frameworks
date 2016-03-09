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
        // TODO: Implement __invoke() method.
    }
}


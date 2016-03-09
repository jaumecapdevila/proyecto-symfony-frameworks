<?php


namespace CacheBundle\EventListener;

use CacheBundle\Services\FilmsCacher;
use Symfony\Component\EventDispatcher\Event;

class FilmsListed
{
    private $filmsCacher;

    public function __construct(FilmsCacher $filmsCacher)
    {
        $this->filmsCacher = $filmsCacher;
    }

    public function addFilmsListToCache()
    {
        $this->filmsCacher->createCache();
    }
}

<?php


namespace CacheBundle\EventListener;

use CacheBundle\Services\FilmsCacher;
use Symfony\Component\EventDispatcher\Event;

class FilmsListUpdated
{
    private $filmsCacher;

    public function __construct(FilmsCacher $filmsCacher)
    {
        $this->filmsCacher = $filmsCacher;
    }

    public function updateFilmsListCache()
    {
        $this->filmsCacher->createCache();
    }
}

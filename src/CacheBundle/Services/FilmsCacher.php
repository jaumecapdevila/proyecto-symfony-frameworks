<?php

namespace CacheBundle\Services;


use Doctrine\ORM\EntityManager;

class FilmsCacher
{
    const CACHE_FILE = __DIR__ . '/../../../var/cache/filmsCache.txt';

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createCache()
    {
        $filmList           = $this->entityManager->getRepository('FilmBundle:Film')->findAll();
        $serializedFilmList = [];
        foreach ($filmList as $film) {
            $serializedFilmList[] = serialize($film) . "\n";
        }
        file_put_contents(self::CACHE_FILE, $serializedFilmList);
    }
}


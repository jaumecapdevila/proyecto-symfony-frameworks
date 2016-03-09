<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;
use CacheBundle\EventListener\FilmAdded;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CreateFilm
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Film $film)
    {
        $this->entityManager->persist($film);
        $this->entityManager->flush($film);

        $listener = new FilmAdded();
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener('film.added', array($listener, 'removeCacheAfterFilmAdded'));
    }
}


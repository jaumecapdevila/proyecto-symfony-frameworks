<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;
use CacheBundle\EventListener\FilmRemoved;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;

class RemoveFilm
{
    private $entityManager;
    /** @var SearchFilmById  */
    private $searchFilmByIdService;
    private $eventDispatcher;

    public function __construct(EntityManager $entityManager, SearchFilmById $searchFilmById, TraceableEventDispatcher $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->searchFilmByIdService = $searchFilmById;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke($id)
    {
        $film = call_user_func($this->searchFilmByIdService, $id);
        $this->entityManager->remove($film);
        $this->entityManager->flush();
        $this->eventDispatcher->dispatch('film.removed');
    }
}


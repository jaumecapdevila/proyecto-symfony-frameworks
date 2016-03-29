<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use CacheBundle\EventListener\FilmRemoved;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RemoveFilm
{
    private $entityManager;
    /** @var SearchFilmById  */
    private $searchFilmByIdService;
    private $eventDispatcher;

    public function __construct(
        EntityManager $entityManager, 
        SearchFilmById $searchFilmById,
        EventDispatcherInterface $eventDispatcher)
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


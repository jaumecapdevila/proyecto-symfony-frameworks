<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;

class RemoveFilm
{
    private $entityManager;
    /** @var SearchFilmById  */
    private $searchFilmByIdService;

    public function __construct(EntityManager $entityManager, SearchFilmById $searchFilmById)
    {
        $this->entityManager = $entityManager;
        $this->searchFilmByIdService = $searchFilmById;
    }

    public function __invoke($id)
    {
        $film = $this->searchFilmByIdService($id);
        $this->entityManager->remove($film);
        $this->entityManager->flush();
    }
}


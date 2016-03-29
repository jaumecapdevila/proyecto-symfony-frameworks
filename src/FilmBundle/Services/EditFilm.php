<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EditFilm
{
    private $entityManager;
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

    public function __invoke(Film $editedFilm)
    {
        $filmId = $editedFilm->getId();
        $film = call_user_func($this->searchFilmByIdService, $filmId);

        if (!$film) {
            throw new Exception(
                'No product found for id '.$filmId
            );
        }

        $film->setName($editedFilm->getName());
        $film->setDate($editedFilm->getDate());
        $film->setYear($editedFilm->getYear());
        $film->setImdbUrl($editedFilm->getImdbUrl());

        $this->entityManager->flush($film);

        $this->eventDispatcher->dispatch('film.edited');
    }

}
<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\EventDispatcher\EventDispatcher;
use CacheBundle\EventListener\FilmEdited;

class EditFilm
{
    private $entityManager;
    private $searchFilmByIdService;

    public function __construct(EntityManager $entityManager, SearchFilmById $searchFilmById)
    {
        $this->entityManager = $entityManager;
        $this->searchFilmByIdService = $searchFilmById;
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

        $listener = new FilmEdited();
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener('film.edited', array($listener, 'removeCacheAfterFilmEdited'));

    }

}
<?php

namespace FilmBundle\Services;

use DateTime;
use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Command\CreateFilmCommand;
use FilmBundle\Entity\Film;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateFilmUseCase
{
    private $entityManager;
    private $eventDispatcher;

    public function __construct(
        EntityManager $entityManager,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->entityManager   = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(CreateFilmCommand $createFilmCommand)
    {
        $film = new Film(
            $createFilmCommand->getName(),
            $createFilmCommand->getYear(),
            DateTime::createFromFormat('d/m/Y', $createFilmCommand->getDate()),
            $createFilmCommand->getImdbUrl()
        );
        $this->entityManager->persist($film);
        $this->entityManager->flush($film);
        $this->eventDispatcher->dispatch('film.added');
        return $film;
    }
}
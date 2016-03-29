<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Command\RemoveFilmCommand;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RemoveFilmUseCase
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

    public function __invoke(RemoveFilmCommand $removeFilmCommand)
    {
        $film = call_user_func(
            $this->searchFilmByIdService,
            $removeFilmCommand->getFilmIdToRemove()
        );
        $this->entityManager->remove($film);
        $this->entityManager->flush();
        $this->eventDispatcher->dispatch('film.removed');
    }
}


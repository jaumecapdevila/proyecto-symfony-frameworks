<?php

namespace FilmBundle\Services;

use DateTime;
use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Command\EditFilmCommand;
use FilmBundle\Entity\Film;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EditFilmUseCase
{
    private $entityManager;
    private $searchFilmByIdService;
    private $eventDispatcher;

    public function __construct(
        EntityManager $entityManager,
        SearchFilmById $searchFilmById,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->entityManager         = $entityManager;
        $this->searchFilmByIdService = $searchFilmById;
        $this->eventDispatcher       = $eventDispatcher;
    }

    public function __invoke(EditFilmCommand $editFilmCommand)
    {
        /** @var Film $filmToEdit */
        $filmToEdit = call_user_func(
            $this->searchFilmByIdService,
            $editFilmCommand->getFilmToEditId()
        );

        if (!$filmToEdit) {
            throw new Exception(
                'No product found for id ' . $editFilmCommand->getFilmToEditId()
            );
        }

        $filmToEdit->setName($editFilmCommand->getName());
        $filmToEdit->setDate(DateTime::createFromFormat('d/m/Y', $editFilmCommand->getDate()));
        $filmToEdit->setYear($editFilmCommand->getYear());
        $filmToEdit->setImdbUrl($editFilmCommand->getImdbUrl());

        $this->entityManager->flush($filmToEdit);

        $this->eventDispatcher->dispatch('film.edited');
    }

}
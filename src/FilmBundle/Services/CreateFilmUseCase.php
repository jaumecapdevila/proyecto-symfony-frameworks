<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;

class CreateFilmUseCase
{
    private $entityManager;
    private $eventDispatcher;

    public function __construct(EntityManager $entityManager, TraceableEventDispatcher $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(Film $film)
    {
        $this->entityManager->persist($film);
        $this->entityManager->flush($film);
        $this->eventDispatcher->dispatch('film.added');
    }
}
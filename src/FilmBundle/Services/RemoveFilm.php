<?php

namespace FilmBundle\Services;
use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;

class RemoveFilm
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Film $filmToRemove)
    {
        $this->entityManager->remove($filmToRemove);
        $this->entityManager->flush();
    }
}


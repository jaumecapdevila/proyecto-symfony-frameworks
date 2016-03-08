<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;

class CreateFilm
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Film $film)
    {
        $this->entityManager->persist($film);
        $this->entityManager->flush($film);
    }
}
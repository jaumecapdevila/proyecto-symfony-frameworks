<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;
use Symfony\Component\Config\Definition\Exception\Exception;

class SearchFilmById
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke($id)
    {
        $film = $this->entityManager->getRepository('FilmBundle:Film')->find($id);

        if (!$film) {
            throw new Exception(
                'No film found with the id' . $id
            );
        }

        return $film;
    }
}
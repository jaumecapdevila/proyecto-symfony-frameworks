<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;
use Symfony\Component\Config\Definition\Exception\Exception;

class EditFilm
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Film $editedFilm)
    {
        $filmId = $editedFilm->getId();
        $filmToModify = $this->entityManager->getRepository('FilmBundle:Film')->find($filmId);

        if (!$filmToModify) {
            throw new Exception(
                'No product found for id '.$filmId
            );
        }
        
        $filmToModify->setName($editedFilm->getName());
        $filmToModify->setDate($editedFilm->getDate());
        $filmToModify->setYear($editedFilm->getYear());
        $filmToModify->setImdbUrl($editedFilm->getImdbUrl());

        $this->entityManager->flush($filmToModify);
    }

}
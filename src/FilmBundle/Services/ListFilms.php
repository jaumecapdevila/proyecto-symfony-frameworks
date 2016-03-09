<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use FilmBundle\Entity\Film;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\EventDispatcher\EventDispatcher;
use CacheBundle\EventListener\FilmsListed;


class ListFilms
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function __invoke()
    {
        $filmList = $this->entityManager->getRepository('FilmBundle:Film')->findAll();

        if (!$filmList) {
            throw new Exception(
              '0 films found'
            );
        }
        $listener = new FilmsListed();
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener('films.listed', array($listener, 'addFilmsListToCache'));

        return $filmList;
    }
}

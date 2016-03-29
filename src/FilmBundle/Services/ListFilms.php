<?php

namespace FilmBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class ListFilms implements ListFilmsInterface
{
    private $entityManager;
    private $eventDispatcher;

    public function __construct(EntityManager $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }
    public function __invoke()
    {
        $filmList = $this->entityManager->getRepository('FilmBundle:Film')->findAll();

        if (!$filmList) {
            throw new Exception(
              '0 films found'
            );
        }
        $this->eventDispatcher->dispatch('films.listed');

        return $filmList;
    }
}

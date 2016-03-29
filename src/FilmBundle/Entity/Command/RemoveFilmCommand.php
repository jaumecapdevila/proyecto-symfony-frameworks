<?php

namespace FilmBundle\Entity\Command;


class RemoveFilmCommand
{
    private $filmIdToRemove;

    /**
     * RemoveFilmCommand constructor.
     * @param $filmIdToRemove
     */
    public function __construct($filmIdToRemove)
    {
        $this->filmIdToRemove = $filmIdToRemove;
    }

    /**
     * @return mixed
     */
    public function getFilmIdToRemove()
    {
        return $this->filmIdToRemove;
    }
}


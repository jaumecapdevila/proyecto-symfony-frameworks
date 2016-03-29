<?php

namespace FilmBundle\Services;


class ListFilmsInArrayUseCase
{
    private $row;

    public function __construct()
    {
        $this->row = [];
    }

    public function createArrayList($filmsList)
    {
        foreach ($filmsList as $film) {
            $this->row[] = [
                "id" => $film->getId(),
                "name" => $film->getName(),
                "year" => $film->getYear(),
                "date" => $film->getDate()->format('d/m/Y'),
                "imdbUrl" => $film->getImdbUrl()
            ];
        }

        return $this->row;
    }
}


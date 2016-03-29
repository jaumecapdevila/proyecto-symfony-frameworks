<?php

namespace FilmBundle\Services;


class ListFilmsInArrayUseCase
{
    private $arrayList = [];
    private $listFilmsService;
    
    public function __construct(ListFilmsInterface $listFilms)
    {
        $this->listFilmsService = $listFilms;
    }

    public function __invoke()
    {
        $filmsList = call_user_func($this->listFilmsService);
        foreach ($filmsList as $film) {
            $this->arrayList[] = [
                "id" => $film->getId(),
                "name" => $film->getName(),
                "year" => $film->getYear(),
                "date" => $film->getDate()->format('d/m/Y'),
                "imdbUrl" => $film->getImdbUrl()
            ];
        }

        return $this->arrayList;
    }
}


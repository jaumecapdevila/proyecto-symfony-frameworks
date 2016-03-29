<?php

namespace FilmBundle\Entity\Command;


class CreateFilmCommand
{
    private $name;
    private $year;
    private $date;
    private $imdbUrl;

    /**
     * CreateFilmCommand constructor.
     * @param $name
     * @param $year
     * @param $date
     * @param $imdbUrl
     */
    public function __construct($name, $year, $date, $imdbUrl)
    {
        $this->name    = $name;
        $this->year    = $year;
        $this->date    = $date;
        $this->imdbUrl = $imdbUrl;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getImdbUrl()
    {
        return $this->imdbUrl;
    }
}


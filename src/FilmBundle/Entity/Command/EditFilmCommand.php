<?php

namespace FilmBundle\Entity\Command;


class EditFilmCommand
{
    private $filmToEditId;
    private $name;
    private $year;
    private $date;
    private $imdbUrl;

    /**
     * EditFilmCommand constructor.
     * @param $id
     * @param $name
     * @param $year
     * @param $date
     * @param $imdbUrl
     */
    public function __construct($id, $name, $year, $date, $imdbUrl)
    {
        $this->filmToEditId = $id;
        $this->name         = $name;
        $this->year         = $year;
        $this->date         = $date;
        $this->imdbUrl      = $imdbUrl;
    }

    /**
     * @return mixed
     */
    public function getFilmToEditId()
    {
        return $this->filmToEditId;
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


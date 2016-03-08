<?php

namespace FilmBundle\Entity;


/**
 * Class Film
 * @package FilmApi\Entity
 */
class Film
{
    private $id;
    private $name;
    private $year;
    private $date;
    private $imdbUrl;

    /**
     * Film constructor.
     * @param $name
     * @param $year
     * @param $date
     * @param $imdbUrl
     */
    public function __construct($name, $year, $date, $imdbUrl)
    {
        $this->name = $name;
        $this->year = $year;
        $this->date = $date;
        $this->imdbUrl = $imdbUrl;
    }
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $imdbUrl
     */
    public function setImdbUrl($imdbUrl)
    {
        $this->imdbUrl = $imdbUrl;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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


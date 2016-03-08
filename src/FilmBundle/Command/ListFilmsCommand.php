<?php

namespace FilmBundle\Command;


use FilmBundle\Entity\Film;
use FilmBundle\Services\ListFilms;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListFilmsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('films:list')
            ->setDescription('List all films');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ListFilms $listFilms */
        $listFilms = $this->getContainer()->get('list.films');
        $allFilms  = $listFilms();
        $rows      = [];
        /** @var Film $film */
        foreach ($allFilms as $film) {
            $rows[] = [
                $film->getId(),
                $film->getName(),
                $film->getYear(),
                $film->getDate()->format('d/m/Y'),
                $film->getImdbUrl()
            ];
        }

        $table = new Table($output);
        $table->setStyle('borderless');
        $table
            ->setHeaders(['id', 'name', 'year', 'date', 'imdbUrl'])
            ->setRows($rows);
        ;
        $table->render();
    }
}


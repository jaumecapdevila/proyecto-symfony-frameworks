<?php

namespace FilmBundle\Command;


use DateTime;
use FilmBundle\Entity\Film;
use FilmBundle\Services\CreateFilm;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateFilmCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('film:create')
            ->setDescription('Create a new film')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Film name'
            )
            ->addArgument(
                'year',
                InputArgument::REQUIRED,
                'Film year'
            )
            ->addArgument(
                'date',
                InputArgument::REQUIRED,
                'Film date'
            )
            ->addArgument(
                'imdbUrl',
                InputArgument::REQUIRED,
                'IMDB film URL'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $year = $input->getArgument('year');
        $date = DateTime::createFromFormat('d/m/Y', $input->getArgument('date'));
        $imdbURL = $input->getArgument('imdbUrl');

        $film = new Film($name, $year, $date, $imdbURL);
        /** @var CreateFilm $createFilm */
        $createFilm = $this->getContainer()->get('create.film');
        $createFilm($film);
        $filmId = $film->getId();

        $text = "<fg=green>Film <fg=white>'$name'</> successfully created with id = <fg=white>$filmId</></>";
        $output->writeln($text);
    }
}


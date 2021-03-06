<?php

namespace FilmBundle\Command;


use Exception;
use FilmBundle\Entity\Command\CreateFilmCommand as CommandCreateFilm;
use FilmBundle\Services\CreateFilmUseCase;
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
        $name    = $input->getArgument('name');
        $year    = $input->getArgument('year');
        $date    = $input->getArgument('date');
        $imdbURL = $input->getArgument('imdbUrl');

        $createFilmCommand = new CommandCreateFilm($name, $year, $date, $imdbURL);

        /** @var CreateFilmUseCase $createFilmUseCase */
        try {
            $createFilmUseCase = $this->getContainer()->get('create.film');
            $film              = $createFilmUseCase($createFilmCommand);
            $filmId            = $film->getId();

            $text = "<fg=green>Film <fg=white>'$name'</> successfully created with id = <fg=white>$filmId</></>";
        } catch (Exception $e) {
            $text = "<fg=red>An error has ocurred while adding the new film</>";
        }
        $output->writeln($text);
    }
}


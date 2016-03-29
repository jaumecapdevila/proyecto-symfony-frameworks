<?php

namespace FilmBundle\Command;


use DateTime;
use FilmBundle\Entity\Film;
use FilmBundle\Entity\Command\EditFilmCommand as CommandEditFilm;
use FilmBundle\Services\EditFilmUseCase;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EditFilmCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('film:edit')
            ->setDescription('Edit an existing film')
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'Film id'
            )
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
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id         = $input->getArgument('id');
        $name       = $input->getArgument('name');
        $year       = $input->getArgument('year');
        $date       = $input->getArgument('date');
        $imdbURL    = $input->getArgument('imdbUrl');

        $editFilmCommand = new CommandEditFilm($id, $name, $year, $date, $imdbURL);

        /** @var EditFilmUseCase $editFilmUseCase */
        $editFilmUseCase = $this->getContainer()->get('edit.film');

        try {
            $editFilmUseCase($editFilmCommand);
            $text = "<fg=green>Film with id = <fg=white>$id</> successfully edited</>";
        } catch (Exception $e) {
            $text = "<fg=red>The film with id = <fg=white>$id</> does not exist</>";
        }

        $output->writeln($text);
    }
}


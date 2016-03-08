<?php

namespace FilmBundle\Command;


use DateTime;
use FilmBundle\Entity\Film;
use FilmBundle\Services\EditFilm;
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
        $date       = DateTime::createFromFormat('d/m/Y', $input->getArgument('date'));
        $imdbURL    = $input->getArgument('imdbUrl');
        $editedFilm = new Film($name, $year, $date, $imdbURL);
        $editedFilm->setId($id);

        /** @var EditFilm $editFilm */
        $editFilm   = $this->getContainer()->get('edit.film');

        try {
            $editFilm($editedFilm);
            $text = "<fg=green>Film with id = <fg=white>$id</> successfully edited</>";
        } catch (Exception $e) {
            $text = "<fg=red>The film with id = <fg=white>$id</> does not exist</>";
        }

        $output->writeln($text);
    }
}


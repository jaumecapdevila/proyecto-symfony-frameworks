<?php

namespace FilmBundle\Command;


use FilmBundle\Services\RemoveFilm;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveFilmCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('film:remove')
            ->setDescription('Remove a film')
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'Film ID'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var RemoveFilm $removeFilm */
        $removeFilm = $this->getContainer()->get('remove.film');
        $id         = $input->getArgument('id');

        try {
            $removeFilm($id);
            $text = "<fg=green>Film with id = <fg=white>$id</> successfully removed</>";
        } catch (Exception $e) {
            $text = "<fg=red>The film with id = <fg=white>$id</> does not exist</>";
        }

        $output->writeln($text);
    }

}


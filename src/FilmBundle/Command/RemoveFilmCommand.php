<?php

namespace FilmBundle\Command;


use FilmBundle\Entity\Command\RemoveFilmCommand as CommandRemoveFilm;
use FilmBundle\Services\RemoveFilmUseCase;
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
        /** @var RemoveFilmUseCase $removeFilm */
        $removeFilm = $this->getContainer()->get('remove.film');
        $id         = $input->getArgument('id');

        try {
            $removeFilmCommand = new CommandRemoveFilm($id);
            $removeFilm($removeFilmCommand);
            $text = "<fg=green>Film with id = <fg=white>$id</> successfully removed</>";
        } catch (Exception $e) {
            $text = "<fg=red>The film with id = <fg=white>$id</> does not exist</>";
        }

        $output->writeln($text);
    }

}


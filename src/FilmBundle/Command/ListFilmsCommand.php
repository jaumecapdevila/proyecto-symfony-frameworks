<?php

namespace FilmBundle\Command;


use FilmBundle\Entity\Film;
use FilmBundle\Services\ListFilmsInArrayUseCase;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListFilmsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('film:list')
            ->setDescription('List all films');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ListFilmsInArrayUseCase $listFilmsInArrayUseCase */
        $listFilmsInArrayUseCase = $this->getContainer()->get('list.films.array');
        $filmsArray = $listFilmsInArrayUseCase();

        if (!empty($filmsArray)) {
            $table = new Table($output);
            $table->setStyle('borderless');
            $table
                ->setHeaders(['id', 'name', 'year', 'date', 'imdbUrl'])
                ->setRows($filmsArray);;
            $table->render();
        } else {
            $text = "<fg=red>There are currently no films to list</>";
            $output->writeln($text);
        }
    }
}


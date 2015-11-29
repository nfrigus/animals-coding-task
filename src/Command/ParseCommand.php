<?php


namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ParseCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('parse')
            ->setDescription('Parse a file')
            ->addArgument('file', InputArgument::REQUIRED, 'What do you want to parse?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('file');

        $parseEngine = new \App\ParseEngine();
        $parseEngine->register('ANIMALS', new \App\Strategy\SortedUniqueStrategy);
        $parseEngine->register('NUMBERS', new \App\Strategy\UniqueCountStrategy);
        $parseEngine->parseFile($filename);
        $out = $parseEngine->getResult();

        $output->write($out);
    }
}

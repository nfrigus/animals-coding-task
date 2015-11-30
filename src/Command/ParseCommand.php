<?php


namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ParseCommand extends Command
{
    private $parse_engine;

    public function __construct($engine)
    {
        $this->parse_engine = $engine;
        return parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('parse')
            ->setDescription('Parse a file')
            ->addArgument('file', InputArgument::REQUIRED, 'What do you want to parse?');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('file');

        $this->parse_engine->parseFile($filename);
        $out = $this->parse_engine->getResult();

        $output->write($out);
    }
}

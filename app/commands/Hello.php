<?php
namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Models\Config\Config;

/**
 * The filemanager configuration command.
 *
 * User: Mark Cheptea
 * Date: 10/27/2015
 * Time: 4:40 PM
 */
class Hello extends Command
{
    protected $commandName = "hello";
    protected $commandDescription = "Greets you!";

    protected $commandArgName = "name";
    protected $commandArgDescription = "Your name.";

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgName,
                InputArgument::REQUIRED,
                $this->commandArgDescription
            )
        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument($this->commandArgName);

        $output->writeln("Hello " . $name . "!! :)");
    }
}
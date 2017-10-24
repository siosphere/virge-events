<?php
namespace Virge\Event\Command;

use Virge\Core\Config;
use Virge\Cli;
use Virge\Cli\Component\{
    Command,
    Input,
    Option
};

class InitCommand extends Command
{
    const COMMAND = 'virge:event:init';
    const COMMAND_HELP = 'Create event table';

    public function run(Input $input)
    {
        Cli::important('Virge::Event');

        $command = new Input();
        $command->setCommand('virge:db:schema:commit')
        ->setOptions([
            'dir' => new Option('dir', Config::path('Virge\\Event@resources/setup/db/')),
        ]);

        Cli::execute($command);

        Cli::success('DONE');
    }
}
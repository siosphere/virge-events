<?php
namespace Virge\Event\Command;

use Virge\Core\Config;
use Virge\Cli;
use Virge\Cli\Component\{
    Command,
    Input
};

class InitCommand extends Command
{
    const COMMAND = 'virge:event:init';
    const COMMAND_HELP = 'Create event table';

    public function run(Input $input)
    {
        Cli::important('Virge::Event');

        Cli::execute('db:schema:commit', [
            Config::path('Virge\\Event@resources/setup/db/'),
        ]);

        Cli::success('DONE');
    }
}
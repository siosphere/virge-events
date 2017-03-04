<?php
namespace Virge\Event\Command;

use Virge\Core\Config;
use Virge\Cli;
use Virge\Cli\Component\Command;

class InitCommand extends Command
{
    const COMMAND = 'virge:event:init';

    public function run()
    {
        Cli::output('Virge::Event');

        Cli::execute('db:schema:commit', [
            Config::path('Virge\\Event@resources/setup/db/'),
        ]);

        Cli::output('DONE');
    }
}
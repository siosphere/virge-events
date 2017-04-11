<?php

use Virge\Event\Command\{
    SupervisorCommand,
    InitCommand
};

use Virge\Cli;

Cli::add(InitCommand::COMMAND, InitCommand::class)
    ->setHelpText(InitCommand::COMMAND_HELP)
;

Cli::add(SupervisorCommand::COMMAND, SupervisorCommand::class)
    ->setHelpText(SupervisorCommand::COMMAND_HELP)
;
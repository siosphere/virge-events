<?php

use Virge\Event\Command\{
    SupervisorCommand,
    InitCommand
};

use Virge\Cli;

Cli::add(InitCommand::COMMAND, InitCommand::class);
Cli::add(SupervisorCommand::COMMAND, SupervisorCommand::class);
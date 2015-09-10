<?php

use Virge\Event\Command\AsyncEventRunnerCommand;

use Virge\Cli;

/**
 * 
 * @author Michael Kramer
 */
Cli::add(AsyncEventRunnerCommand::COMMAND . ':init', "\\Virge\\Event\\Command\\AsyncEventRunnerCommand", "init");
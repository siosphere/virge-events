<?php
namespace Virge\Event\Command;

use Virge\Cli;
use Virge\Cli\Component\{
    Command,
    Input
};
use Virge\Event\Model\AsyncEvent;
use Virge\Event\Service\EventRunnerService;
use Virge\ORM\Component\Collection;
use Virge\ORM\Component\Collection\Filter;
use Virge\Virge;

/**
 *
 */
class SupervisorCommand extends Command
{
    const COMMAND = 'virge:event:supervisor';
    const COMMAND_HELP = 'Run event supervisor to run async events that should process';

    public function run(Input $input) 
    {
        if($this->instanceAlreadyRunning()) {
            Cli::error("Virge::Event Supervisor already running");
            $this->terminate(-1);
        }

        Cli::important("Starting Virge::Event Supervisor");

        $this->runAsyncEvents();

        Cli::success("DONE");
    }

    public function runAsyncEvents()
    {
        $collection = Collection::model(AsyncEvent::class)->filter(function() {
            Filter::eq('status', AsyncEvent::STATUS_SCHEDULED);
            Filter::lte('run_at', new \DateTime);
        })->setLimit(1000)->setForUpdate(true);

        while($asyncEvent = $collection->fetch()) {
            $this->getEventRunnerService()->queueEvent($asyncEvent);
        }
    }

    protected function getEventRunnerService() : EventRunnerService
    {
        return Virge::service(EventRunnerService::class);
    }
}
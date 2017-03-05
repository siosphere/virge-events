<?php
namespace Virge\Event\Command;

use Virge\Cli;
use Virge\Cli\Component\Command;
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

    public function run() 
    {
        if($this->instanceAlreadyRunning()) {
            Cli::output("Virge::Event Supervisor already running");
        }

        Cli::output("Starting Virge::Event Supervisor");

        $this->runAsyncEvents();

        Cli::output("DONE");
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
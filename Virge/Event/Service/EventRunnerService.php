<?php
namespace Virge\Event\Service;

use Virge\Event\Dispatcher;
use Virge\Event\Model\{
    AsyncEvent, 
    Event
};
use Virge\Event\Service\EventService;
use Virge\Virge;

class EventRunnerService
{
    public function runEvent(int $eventId)
    {
        $asyncEvent = $this->getEventService()->getAsyncEvent($eventId);
        if(!$asyncEvent) {
            throw new \Exception("Invalid event");
        }

        $event = $this->getEventService()->getEventFromAsyncEvent($asyncEvent);
        
        if(!$event) {
            throw new \Exception("Invalid Event");
        }

        $asyncEvent
            ->setStartedOn(new \DateTime)
            ->setStartedBy(sprintf('%s:%s', gethostname(), getmypid()))
            ->save()
        ;
        try {
            $output = Dispatcher::dispatch($event);
            $asyncEvent->setEndedOn(new \DateTime)
                ->setOutput($output)
                ->save()
            ;
        } catch(\Throwable $t) {
            $asyncEvent->setAttempts(intval($asyncEvent->getAttempts()) + 1)
                ->setStatus(AsyncEvent::STATUS_FAIL)
                ->setOutput($t->getMessage())
                ->save()
            ;
        }
    }

    public function getEventService() : EventService
    {
        return Virge::service(EventService::class);
    }
}
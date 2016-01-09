<?php
namespace Virge\Event\Service;

use Virge\Event\Model\Event;
use Virge\Event\Dispatcher;
/**
 * 
 * @author Michael Kramer
 */
class EventService {
    
    const SERVICE_ID = 'virge.event.service.event';
    
    /**
     * Signal an event
     * @param Event $event
     */
    public function signal(Event $event) {
        Dispatcher::dispatch($event);
    }
    
    /**
     * Signal an async event
     * @param Event $event
     * @param \DateTime $runAt
     */
    public function signalAsync(Event $event, $runAt = null) {
        
        $event->setClassName(get_class($event));
        $event->setName(get_class($event));
        $event->setRunAt($runAt);
        $event->setParams(json_encode($event));
        $event->save();
    }
}
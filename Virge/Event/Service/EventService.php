<?php
namespace Virge\Event\Service;

use Virge\Event\Model\{
    AsyncEvent,
    Event
};
use Virge\Event\Dispatcher;
/**
 * 
 * @author Michael Kramer
 */
class EventService 
{
    
    const SERVICE_ID = 'virge.event.service.event';
    
    /**
     * Signal an event
     * @param Event $event
     */
    public function signal(Event $event) 
    {
        Dispatcher::dispatch($event);
    }
    
    public function getAsyncEvent(int $eventId)
    {
        $event = new AsyncEvent();
        if(!$event->load($eventId)) {
            return null;
        }

        return $event;
    }

    public function getEventFromAsyncEvent(AsyncEvent $asyncEvent)
    {
        $params = json_decode($asyncEvent->getParams(), true);
        if(!$params) {
            $params = [];
        }

        $arguments = [];

        $realEventClass = new \ReflectionClass($asyncEvent->getClassName());
        $constructor = $realEventClass->getConstructor();
        foreach($constructor->getParameters() as $constructorParam) {
            $arguments[] = $params[$constructorParam->getName()];
        }

        return $realEventClass->newInstanceArgs($arguments);
    }

    public function getEventParameters(Event $event) : array
    {
        $realEventClass = new \ReflectionClass(get_class($event));
        $constructor = $realEventClass->getConstructor();
        $params = [];
        foreach($constructor->getParameters() as $constructorParam) {
            $params[$constructorParam->getName()] = $event->get($constructorParam->getName());
        }

        return $params;
    }
}
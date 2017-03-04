<?php
namespace Virge\Event;

use Virge\Event\Component\Listener;
use Virge\Event\Component\Event;
use Virge\Event\Model\{
    AsyncEvent
};
use Virge\Event\Service\EventService;
use Virge\Virge;

/**
 * Used to Dispatch events, and queue Async Events, as well as 
 * register listeners
 */
class Dispatcher
{
    
    protected static $listeners = [];
    
    /**
     * Attach a listener on the given event name
     * @param string $eventName
     * @param mixed $callable
     * @param string|null $method
     */
    public static function listen($eventName, $callable, $method = null) 
    {
        if(!isset(self::$listeners[$eventName])){
            self::$listeners[$eventName] = array();
        }
        
        self::$listeners[$eventName][] = new Listener($eventName, $callable, $method);
    }
    
    /**
     * Dispatch an event to any registered listeners
     * @param \Virge\Event\Component\Event $event
     */
    public static function dispatch(Event $event) 
    {
        $eventName = get_class($event);
        
        if(!isset(self::$listeners[$eventName])){
            return 'No registered listeners';
        }
        
        ob_start();
        
        foreach(self::$listeners[$eventName] as $listener) {
            if(!$event->shouldPropagate()) {
                continue;
            }
            $listener->listen($event);
        }
        
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    public static function async(Event $event, \DateTime $runAt = null)
    {
        if(!$runAt) {
            $runAt = new \DateTime;
        }

        $asyncEvent = new AsyncEvent();

        $params = self::getEventService()->getEventParameters($event);

        $params = json_encode($params);

        $asyncEvent
            ->setRunAt($runAt)
            ->setStatus(AsyncEvent::STATUS_SCHEDULED)
            ->setClassName(get_class($event))
            ->setParams($params)
        ;

        return $asyncEvent->save();
    }
    
    protected static function getEventService() : EventService
    {
        return Virge::service(EventService::SERVICE_ID);
    }
}
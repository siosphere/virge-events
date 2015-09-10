<?php
namespace Virge\Event;

use Virge\Event\Component\Listener;
use Virge\Event\Model\Event;

/**
 * 
 * @author Michael Kramer
 */

class Dispatcher {
    
    protected static $listeners = array();
    
    /**
     * Attach a listener on the given event name
     * @param string $eventName
     * @param mixed $callable
     * @param string|null $method
     */
    public static function listen($eventName, $callable, $method = null) {
        if(!isset(self::$listeners[$eventName])){
            self::$listeners[$eventName] = array();
        }
        
        
        self::$listeners[$eventName][] = new Listener($eventName, $callable, $method);
    }
    
    /**
     * Dispatch an event to any registered listeners
     * @param \Virge\Event\Model\Event $event
     */
    public static function dispatch(Event $event) {
        $eventName = $event::EVENT_NAME;
        
        self::startEvent($event);
        
        if(!isset(self::$listeners[$eventName])){
            self::endEvent($event, 'No registered listeners');
            return false;
        }
        
        
        ob_start();
        
        foreach(self::$listeners[$eventName] as $listener) {
            
            $listener->listen($event);
        }
        
        $output = ob_get_contents();
        ob_end_clean();
        
        self::endEvent($event, $output);
    }
    
    protected static function startEvent(Event $event) {
        if(!$event->isAsync()){
            return;
        }
        $event->setStartedOn(new \DateTime);
        $event->save();
    }
    
    protected static function endEvent(Event $event, $output = null) {
        if(!$event->isAsync()){
            return;
        }
        $event->setEndedOn(new \DateTime);
        $event->setOutput($output);
        $event->save();
    }
}
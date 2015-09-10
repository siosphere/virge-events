<?php
namespace Virge\Event\Component;

use Virge\Event\Model\Event;

use Virge\Virge;

/**
 * 
 * @author Michael Kramer
 */
class Listener extends \Virge\Core\Model {
    
    /**
     * 
     * @param string $eventName
     * @param mixed $callable
     * @param string|null $method
     */
    public function __construct($eventName, $callable, $method = null) {
        $this->setEventName($eventName);
        $this->setCallable($callable);
        $this->setMethod($method);
        parent::__construct();
    }
    
    /**
     * Listen on the given event, and call our callable
     * @param Event $event
     * @return boolean
     * @throws \RuntimeException
     */
    public function listen(Event $event) {
        if(is_callable($this->getCallable())){
            return call_user_func_array($this->getCallable(), array($event));
        }
        
        if($this->getMethod() && $service = Virge::service($this->getCallable())) {
            return call_user_func_array(array($service, $this->getMethod()), array($event));
        }

        throw new \RuntimeException(sprintf("Invalid listener: %s, cannot listen on event type: %s", get_class($this), get_class($event)));
    }
}
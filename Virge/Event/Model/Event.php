<?php

namespace Virge\Event\Model;

/**
 * 
 * @author Michael Kramer
 */
class Event extends \Virge\ORM\Component\Model {
    protected $_table = 'async_event';
    
    protected $async = false;
    
    protected $propagate = true;
    
    /**
     * Stop this event from propagating to any other listeners
     * @return \Virge\Event\Model\Event
     */
    public function stopPropagation()
    {
        $this->propagate = false;
        return $this;
    }
    
    /**
     * Should this event continue to propagate to other listeners
     * @return boolean
     */
    public function shouldPropagate()
    {
        return $this->propagate;
    }
    
    /**
     * Are we an async event?
     * @return boolean
     */
    public function isAsync() {
        return $this->async;
    }
    
    /**
     * Set this event to be async or not
     * @param boolean $async
     * @return \Virge\Event\Model\Event
     */
    public function setAsync($async){
        $this->async = $async;
        return $this;
    }
}
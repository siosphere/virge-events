<?php

namespace Virge\Event\Model;

/**
 * 
 * @author Michael Kramer
 */
class Event extends \Virge\ORM\Component\Model {
    protected $_table = 'async_event';
    
    protected $async = false;
    
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
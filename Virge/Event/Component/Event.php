<?php
namespace Virge\Event\Component;

/**
 * 
 */
class Event extends \Virge\Core\Model 
{
    protected $async = false;
    
    protected $propagate = true;
    
    /**
     * Stop this event from propagating to any other listeners
     * @return \Virge\Event\Component\Event
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
}
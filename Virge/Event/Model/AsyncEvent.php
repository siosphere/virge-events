<?php
namespace Virge\Event\Model;

class AsyncEvent extends \Virge\ORM\Component\Model 
{
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_QUEUED = 'queued';
    const STATUS_PROCESSING = 'processing';
    const STATUS_OK = 'ok';
    const STATUS_FAIL = ' fail';
    
    protected $_table = 'virge_event';
}
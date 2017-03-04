<?php
namespace Virge\Event\Task;

use Virge\Graphite\Component\Task;

class RunAsyncEventTask extends Task
{
    const TASK_NAME = 'virge:event:task:run_async_event';

    protected $event_id;

    public function __construct(int $eventId)
    {
        $this->event_id = $eventId;
    }

    public function getEventId()
    {
        return $this->event_id;
    }
}
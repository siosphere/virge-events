<?php
namespace Virge\Event;

use Virge\Api\Component\ApiWrapper;
use Virge\Event\Controller\AsyncEventApiController;

class EventApi extends ApiWrapper
{
    public static function runAsyncEvent(int $eventId)
    {
        return self::_post(AsyncEventApiController::RUN_ASYNC_EVENT, [
            'eventId' => $eventId,
        ]);
    }
}
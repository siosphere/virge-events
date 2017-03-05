<?php
namespace Virge\Event\Controller;

use Virge\Api\Controller\InternalApiController;
use Virge\Api\Exception\ApiException;
use Virge\Database;
use Virge\Event\Model\AsyncEvent;
use Virge\Event\Service\EventRunnerService;
use Virge\Router\Component\Request;
use Virge\Virge;

class AsyncEventApiController extends InternalApiController
{
    const RUN_ASYNC_EVENT = '/virge/event/{eventId}/run';

    public function runAsyncEvent(Request $request)
    {
        try {
            
            $eventId = $request->getUrlParam('eventId');

            return [
                'success' => $this->getEventRunnerService()->runEvent($eventId),
            ];

        } catch(\Exception $ex) {
            //set status to error if it exists
            Database::query("UPDATE `virge_event` SET `status` = ? WHERE `id` = ? LIMIT 1", [AsyncEvent::STATUS_FAIL, $eventId]);
            throw new ApiException("Failed to run event");
        }
    }

    protected function getEventRunnerService() : EventRunnerService
    {
        return Virge::service(EventRunnerService::class);
    }
}
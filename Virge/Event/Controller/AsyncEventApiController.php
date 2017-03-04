<?php
namespace Virge\Event\Controller;

use Virge\Api\Controller\InternalApiController;
use Virge\Api\Exception\ApiException;
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
            throw new ApiException("Failed to run event");
        }
    }

    protected function getEventRunnerService() : EventRunnerService
    {
        return Virge::service(EventRunnerService::class);
    }
}
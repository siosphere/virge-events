<?php

use Virge\Event\Service\{
    EventService,
    EventRunnerService
};

use Virge\Virge;

$eventService = new EventService();
Virge::registerService(EventService::SERVICE_ID, $eventService);
Virge::registerService(EventService::class, $eventService);

Virge::registerService(EventRunnerService::class, new EventRunnerService());
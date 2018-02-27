<?php

use Virge\Event\Service\{
    EventService,
    EventRunnerService
};

use Virge\Virge;


Virge::registerService(EventService::class, EventService::class);
Virge::registerService(EventService::SERVICE_ID, function() {
    return Virge::service(EventService::class);
});

Virge::registerService(EventRunnerService::class, EventRunnerService::class);
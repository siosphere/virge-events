<?php

use Virge\Event\Service\EventService;

use Virge\Virge;

/**
 * 
 * @author Michael Kramer
 */
Virge::registerService(EventService::SERVICE_ID, new EventService());
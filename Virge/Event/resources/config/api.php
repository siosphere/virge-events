<?php

use Virge\Api;
use Virge\Core\Config;
use Virge\Event\Controller\AsyncEventApiController;

$apiVersion = Config::get('app', 'event_api_version') ?? 'all';

$runEndpoint = Api::post(AsyncEventApiController::RUN_ASYNC_EVENT);
if(Config::get('app', 'event_api_verifier')) {
    $runEndpoint->verify(Config::get('app', 'event_api_verifier'));
}

$runEndpoint->version($apiVersion, AsyncEventApiController::class, 'runAsyncEvent');
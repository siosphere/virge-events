<?php
use Virge\Cli;
use Virge\Event\EventApi;
use Virge\Event\Task\RunAsyncEventTask;
use Virge\Graphite\Worker;

Worker::consume(RunAsyncEventTask::TASK_NAME, function(RunAsyncEventTask $task) {
    Cli::output('Running Async Task: ' . $task->getEventId());
    return EventApi::runAsyncEvent($task->getEventId());
});
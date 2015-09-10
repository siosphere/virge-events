<?php
namespace Virge\Event\Command;

use Virge\Core\Config;

/**
 * 
 * @author Michael Kramer
 */
class AsyncEventRunnerCommand {
    
    const COMMAND = 'virge:event:async_event_runner';
    
    public function run() {
        //todo
    }
    
    public function init() {
        require_once Config::path("\\Virge\\Event@setup/events.php");
    }
}
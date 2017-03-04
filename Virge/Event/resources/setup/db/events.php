<?php

use Virge\Database\Component\Schema;

Schema::create(function() {
    Schema::table('virge_event');
    Schema::id('id');
    Schema::string('status');
    Schema::string('class_name');
    Schema::text('params');
    Schema::timestamp('run_at');
    Schema::timestamp('started_on');
    Schema::timestamp('ended_on');
    Schema::string('started_by');
    Schema::text('output');
    Schema::int('attempts');

    Schema::index('status_run_at', ['status', 'run_at']);
    Schema::end();
});
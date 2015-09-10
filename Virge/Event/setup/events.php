<?php

use Virge\Database\Component\Schema;

Schema::create(function() {
    Schema::table('async_event');
    Schema::id('id');
    Schema::string('name');
    Schema::string('class_name');
    Schema::text('params');
    Schema::timestamp('run_at');
    Schema::timestamp('started_on');
    Schema::timestamp('finished_on');
    Schema::timestamp('started_by');
    Schema::text('output');
    Schema::end();
});
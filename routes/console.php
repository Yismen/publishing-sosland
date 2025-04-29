<?php

use App\Console\Commands\SendWelcomeEmailsCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(SendWelcomeEmailsCommand::class)
    ->hourly()
    ->withoutOverlapping();

Schedule::command('telescope:prune --hours=120')
    ->daily();

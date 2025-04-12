<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\SendWelcomeEmailsCommand;

Schedule::command(SendWelcomeEmailsCommand::class)->hourly()->withoutOverlapping();

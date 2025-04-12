<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\ServiceProvider;
use App\Listeners\UpdateEmailSentAtField;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ProvidersEventServiceProvider;

class EventServiceProvider extends ProvidersEventServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen(
            MessageSent::class,
            [UpdateEmailSentAtField::class, 'handle']
        );
    }
}

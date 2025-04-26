<?php

use App\Models\Contact;
use App\Jobs\ProcessGreetCustomers;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use App\Console\Commands\SendWelcomeEmailsCommand;

describe('greet new customers', function () {
    beforeEach(function () {
        Mail::fake(ThankyouForSubscribing::class);
    });

    it('send email to new contacts', function () {
        $contact = Contact::factory()->unNotified()->create();

        ProcessGreetCustomers::dispatch($contact);

        Mail::assertQueued(ThankyouForSubscribing::class);
    });

    it('doesnt send email if there is no new contacts', function () {
        $contact = Contact::factory()->notified()->create();

        ProcessGreetCustomers::dispatch($contact);

        Mail::assertNotQueued(ThankyouForSubscribing::class);
    });

    it('only sends the email once', function () {
        $contact = Contact::factory()->create();

        ProcessGreetCustomers::dispatch($contact);

        $contact->update(['email_sent_at' => now()]);

        ProcessGreetCustomers::dispatch($contact);

        Mail::assertQueuedCount(1);
    });
});

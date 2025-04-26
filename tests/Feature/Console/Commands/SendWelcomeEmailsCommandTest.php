<?php

use App\Models\Contact;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Support\Facades\Mail;
use App\Console\Commands\SendWelcomeEmailsCommand;
use App\Jobs\ProcessGreetCustomers;
use Illuminate\Support\Facades\Queue;

describe('send welcome email command', function () {
    beforeEach(function () {
        Queue::fake([ProcessGreetCustomers::class]);
    });

    it('execute command successfully', function () {
        $this->artisan('app:send-welcome-emails-command')
            ->assertExitCode(0);
    });

    it('queue email to new contacts', function () {
        $contact = Contact::factory()->unNotified()->create();

        $this->artisan(SendWelcomeEmailsCommand::class);

        Queue::assertPushed(ProcessGreetCustomers::class, function ($job) use ($contact) {
            return $job->contact->is($contact);
        });
    });

    it('doesnt queue email if there is no new contacts', function () {
        $contact = Contact::factory()->notified()->create();

        $this->artisan(SendWelcomeEmailsCommand::class);

        Queue::assertNotPushed(ProcessGreetCustomers::class);
    });


    it('queue email to new contacts with an acceptable disposition ', function () {
        $contact = Contact::factory()->unNotified()->create(['disposition' => 'complete']);

        $this->artisan(SendWelcomeEmailsCommand::class);

        Queue::assertPushed(ProcessGreetCustomers::class, function ($job) use ($contact) {
            return $job->contact->is($contact);
        });
    });

    it('doesnt queue email if there is no new contacts with correct disposition', function () {
        $contact = Contact::factory()->unNotified()->create(['disposition' => 'Something unacceptable']);

        $this->artisan(SendWelcomeEmailsCommand::class);

        Queue::assertNotPushed(ProcessGreetCustomers::class, function ($job) use ($contact) {
            return $job->contact->is($contact);
        });
    });

    it('is schedulled to run every hourly', function () {

        $addedToScheduler = collect(app()->make(\Illuminate\Console\Scheduling\Schedule::class)->events())
            ->filter(function ($element) {
                return str($element->command)->contains('app:send-welcome-emails-command');
            })->first();

        $this->assertNotNull($addedToScheduler);
        $this->assertEquals('0 * * * *', $addedToScheduler->expression);
    });
});

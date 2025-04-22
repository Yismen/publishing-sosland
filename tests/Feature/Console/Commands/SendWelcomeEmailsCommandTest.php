<?php

use App\Models\Contact;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Support\Facades\Mail;
use App\Console\Commands\SendWelcomeEmailsCommand;

describe('fake email', function() {
    beforeEach(function () {
        Mail::fake(ThankyouForSubscribing::class);
    });
    
    it('execute command successfully', function () {
        $this->artisan('app:send-welcome-emails-command')
            ->assertExitCode(0);
    });
    // test email is only sent if status is in config mailables
    // test if the email_sent_at_column is not empty
    // it updates the email sent at column only if the email was sent succesfully
    
    
    it('send email to new contacts', function () {
        $contact = Contact::factory()->unNotified()->create();
    
        $this->artisan(SendWelcomeEmailsCommand::class);
    
        Mail::assertQueued(ThankyouForSubscribing::class, $contact->email);
    });
    
    it('doesnt send email if there is no new contacts', function () {
        $contact = Contact::factory()->notified()->create();
    
        $this->artisan(SendWelcomeEmailsCommand::class);
    
        Mail::assertNothingQueued();
    });
    
    
    it('send email to new contacts with disposition complete', function () {
        $contact = Contact::factory()->unNotified()->create(['disposition' => 'complete']);
    
        $this->artisan(SendWelcomeEmailsCommand::class);
    
        Mail::assertQueued(ThankyouForSubscribing::class, $contact->email);
    });
    
    it('doesnt send email if there is no new contacts with correct disposition', function () {
        $contact = Contact::factory()->unNotified()->create(['disposition' => 'Something unacceptable']);
    
        $this->artisan(SendWelcomeEmailsCommand::class);
    
        Mail::assertNothingQueued();
    });
    
    it('is schedulled to run every hourly', function () {
    
        $addedToScheduler = collect(app()->make(\Illuminate\Console\Scheduling\Schedule::class)->events())
            ->filter(function ($element) {
                return str($element->command)->contains('app:send-welcome-emails-command');
            })->first();
    
        $this->assertNotNull($addedToScheduler);
        $this->assertEquals('0 * * * *', $addedToScheduler->expression);
    });

     it('change the email sent attribute when email is sent', function () {
        $contact = Contact::factory()->unNotified()->create(['disposition' => 'complete']);
    
        $this->artisan(SendWelcomeEmailsCommand::class);
    
        $this->assertNotNull($contact->fresh()->email_sent_at);
    });
    
    it('change the email sent at attribute to null when the email fails to send', function () {
        Mail::fake(ThankyouForSubscribing::class);
        $contact = Contact::factory()->unNotified()->create();

        Mail::shouldReceive('to')
            ->once()
            ->andReturnSelf();

        Mail::shouldReceive('send')
            ->once()
            ->andThrow(new \Exception('Email failed send to send'));

        $this->artisan(SendWelcomeEmailsCommand::class);

        $this->assertNull($contact->fresh()->email_sent_at);
    });
});
    
   

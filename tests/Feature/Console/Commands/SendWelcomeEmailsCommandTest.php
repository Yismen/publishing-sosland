<?php

use App\Models\Contact;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Support\Facades\Mail;
use App\Console\Commands\SendWelcomeEmailsCommand;

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
    $notifiable = Contact::factory()->unNotified()->create();

    $this->artisan(SendWelcomeEmailsCommand::class);

    Mail::assertQueued(ThankyouForSubscribing::class, $notifiable->email);
});

it('doesnt send email if there is no new contacts', function () {
    $notifiable = Contact::factory()->notified()->create();

    $this->artisan(SendWelcomeEmailsCommand::class);

    Mail::assertNothingQueued();
});


it('send email to new contacts with disposition complete', function () {
    $notifiable = Contact::factory()->unNotified()->create(['disposition' => 'complete']);

    $this->artisan(SendWelcomeEmailsCommand::class);

    Mail::assertQueued(ThankyouForSubscribing::class, $notifiable->email);
});

it('doesnt send email if there is no new contacts with correct disposition', function () {
    $notifiable = Contact::factory()->unNotified()->create(['disposition' => 'Something unacceptable']);

    $this->artisan(SendWelcomeEmailsCommand::class);

    Mail::assertNothingQueued();
});

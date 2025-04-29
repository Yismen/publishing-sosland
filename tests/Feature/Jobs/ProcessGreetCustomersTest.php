<?php

use App\Jobs\ProcessGreetCustomers;
use App\Mail\ThankyouForSubscribing;
use App\Models\Contact;
use App\Models\EmailFail;
use Illuminate\Support\Facades\Mail;

describe('greet new customers', function () {
    beforeEach(function () {
        Mail::fake(ThankyouForSubscribing::class);
    });

    it('send email to new contacts', function () {
        $contact = Contact::factory()->unNotified()->create();

        ProcessGreetCustomers::dispatch($contact);

        Mail::assertSent(ThankyouForSubscribing::class);
    });

    it('doesnt send email if there is no new contacts', function () {
        $contact = Contact::factory()->notified()->create();

        ProcessGreetCustomers::dispatch($contact);

        Mail::assertNotSent(ThankyouForSubscribing::class);
    });

    it('only sends the email once', function () {
        $contact = Contact::factory()->create();

        ProcessGreetCustomers::dispatch($contact);

        $contact->update(['email_sent_at' => now()]);

        ProcessGreetCustomers::dispatch($contact);

        Mail::assertSentCount(1);
    });

    it('saves a record of the email when it fails', function () {
        $contact = Contact::factory()->create(['email' => 'invalid-email']);

        Mail::shouldReceive('send')
            ->once()
            ->andThrow(new \Exception('Invalid email address'));

        ProcessGreetCustomers::dispatch($contact);

        $this->assertDatabaseHas(EmailFail::class, [
            'email_failed_at' => now()->format('Y-m-d H:i:s'),
            'failable_id' => $contact->id,
            'failable_type' => Contact::class,
            // 'data' => json_encode($contact->toArray()),
            // 'exception' => json_encode([
            //     'message' => 'Invalid email address',
            //     'code' => 0,
            //     'file' => __FILE__,
            //     'line' => __LINE__,
            // ]),
        ]);
    });
});

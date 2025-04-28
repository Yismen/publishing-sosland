<?php

// it selects the correct file based on campaign

use App\Mail\ThankyouForSubscribing;
use App\Models\Contact;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

describe('thank you for subscribing email', function () {
    beforeEach(function () {
        Mail::fake(ThankyouForSubscribing::class);
    });

    it('has the right subject', function () {
        $contact = Contact::factory()->unNotified()->create();

        $mailable = new ThankyouForSubscribing($contact);

        $mailable->assertHasSubject('Thank you for Subscribing');
    });

    it('has the default text', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'Anything containing milling in it',
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        $mailable->assertSeeInHtml('If you have questions about your subscription, email');
    });

    it('has pet food texts on template', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'PET_FOOD_PROCESSING',
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        $mailable->assertSeeInHtml('petfoodprocessing.net');
    });

    it('has food business texts on template', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'FOOD_BUSINESS',
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        // $mailable->assertSeeInHtml('foodbusiness-logo');
        $mailable->assertSeeInHtml('foodbusinessnews.net');
    });

    it('has milling and baking texts on template', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'BAKING',
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        // $mailable->assertSeeInHtml('millingandbaking-logo');
        $mailable->assertSeeInHtml('bakingbusiness.com');
    });

    // it('listen to the message sent event', function () {
    //     $contact = Contact::factory()->unNotified()->create();
    //     Event::fake(MessageSent::class);

    //     Mail::send(new ThankyouForSubscribing($contact));

    //     Event::assertListening(
    //         MessageSent::class,
    //         \App\Listeners\UpdateEmailSentAtField::class
    //     );
    // });
});

// it('listen to the message sent event message sent', function () {
//     $contact = Contact::factory()->unNotified()->create();

//     Mail::sendNow(new ThankyouForSubscribing($contact));

// });

<?php

// it selects the correct file based on campaign

use App\Models\Contact;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Mail\Events\MessageSent;

describe('model', function () {
    beforeEach(function () {
        Mail::fake(ThankyouForSubscribing::class);
    });

    it('has the right subject', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'Anything containing milling in it'
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        $mailable->assertHasSubject('Thank you for Subscribing');
    });

    it('has the defaul text', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'Anything containing milling in it'
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        $mailable->assertSeeInHtml('If you have questions about your subscription, email');
    });

    it('has pet food texts on template', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'PET_FOOD_PROCESSING'
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        // $mailable->assertSeeInHtml('petfoodprocessing-logo');
        $mailable->assertSeeInHtml('petfoodprocessing.net');
    });

    it('has food business texts on template', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'FOOD_BUSINESS'
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        // $mailable->assertSeeInHtml('foodbusiness-logo');
        $mailable->assertSeeInHtml('foodbusinessnews.net');
    });

    it('has milling and baking texts on template', function () {
        $contact = Contact::factory()->unNotified()->create([
            'campaign' => 'BAKING'
        ]);

        $mailable = new ThankyouForSubscribing($contact);

        // $mailable->assertSeeInHtml('millingandbaking-logo');
        $mailable->assertSeeInHtml('bakingbusiness.net');
    });
});

// it('updates the email sent at field in the contact after the email is sent ', function () {
//     $contact = Contact::factory()->unNotified()->create([
//         'campaign' => 'milling in it'
//     ]);

//     // Mail::sendNow((new ThankyouForSubscribing($contact))->to($contact));
//     Mail::send(new ThankyouForSubscribing($contact))->to($contact);

//     expect($contact->email_sent_at)
//         ->not->toBeNull();
// });

// fires event contat_aequired_email_sent

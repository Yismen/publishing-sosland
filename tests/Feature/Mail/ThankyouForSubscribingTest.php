<?php

// it selects the correct file based on campaign

use App\Models\Contact;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Support\Facades\Mail;

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
        'campaign' => 'Anything containing milling in it'
    ]);

    $mailable = new ThankyouForSubscribing($contact);

    $mailable->assertSeeInHtml('petfood-logo');
    $mailable->assertSeeInHtml('petfoodprocessing.net');
});


// fires event contat_aequired_email_sent

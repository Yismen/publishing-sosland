<?php

use App\Models\Contact;

it('save correct fields', function () {
    $data = Contact::factory()->make();

    Contact::create($data->toArray());

    $this->assertDatabaseHas(Contact::class, $data->only([
        'first_name',
        'last_name',
        'date',
        'email',
        'campaign',
        'disposition',
        'email_sent_at',
    ]));
});

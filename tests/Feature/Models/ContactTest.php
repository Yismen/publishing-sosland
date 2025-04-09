<?php

use App\Models\Contact;

it('save correct fields', function () {
    $data = Contact::factory()->make();

    Contact::create($data->toArray());

    $this->assertDatabaseHas(Contact::class, $data->only([
        'name',
        'last_name',
        'date',
        'email',
        'campaign',
        'email_sent_at',
    ]));
});

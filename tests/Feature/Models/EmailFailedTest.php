<?php

use App\Models\EmailFail;

it('save correct fields', function () {
    $data = EmailFail::factory()->make();

    EmailFail::create($data->toArray());

    $this->assertDatabaseHas(EmailFail::class, $data->only([
        'email_failed_at',
        'failable_id',
        'failable_type',
        // 'data',
        // 'exception',
    ]));
});

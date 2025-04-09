<?php

use App\Models\Campaign;

it('save correct fields', function () {
    $data = Campaign::factory()->make();

    Campaign::create($data->toArray());

    $this->assertDatabaseHas(Campaign::class, $data->only([
        'name'
    ]));
});

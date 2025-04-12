<?php

use App\Models\Disposition;
use App\Traits\Models\InteracstsWithModelCaching;

it('save correct fields', function () {
    $data = Disposition::factory()->make();

    Disposition::create($data->toArray());

    $this->assertDatabaseHas(Disposition::class, $data->only([
        'name',
        'is_mailable'
    ]));
});

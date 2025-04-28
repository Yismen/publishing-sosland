<?php

use App\Models\FailedImportRow;
use App\Traits\Models\InteracstsWithModelCaching;

it('save correct fields', function () {
    $data = FailedImportRow::factory()->make();

    FailedImportRow::create($data->toArray());

    $this->assertDatabaseHas(FailedImportRow::class, $data->only([
        // 'data',
        'import_id',
        'validation_error',
    ]));
});

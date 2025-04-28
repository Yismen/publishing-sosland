<?php

namespace App\Models;

use App\Traits\Models\InteracstsWithModelCaching;
use Filament\Actions\Imports\Models\FailedImportRow as BaseFailedImportRow;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FailedImportRow extends BaseFailedImportRow
{
    /** @use HasFactory<\Database\Factories\FailedImportsFactory> */
    use HasFactory;

    use InteracstsWithModelCaching;

    // protected $table = 'failed_import_rows';

    // protected $fillable = [
    //     'data',
    //     'import_id',
    //     'validation_error',
    // ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\InteracstsWithModelCaching;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disposition extends Model
{
    /** @use HasFactory<\Database\Factories\DispositionFactory> */
    use HasFactory;
    use InteracstsWithModelCaching;

    protected $fillable = ['name', 'is_mailable'];
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => strtolower($value),
        );
    }
}

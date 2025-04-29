<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\InteracstsWithModelCaching;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailFail extends Model
{
    /** @use HasFactory<\Database\Factories\EmailFailedFactory> */
    use HasFactory;
    use InteracstsWithModelCaching;

    protected $fillable = [
        'email_failed_at',
        'failable_id',
        'failable_type',
        'data',
        'exception',
    ];
    protected $casts = [
        'email_failed_at' => 'datetime',
        'data' => 'array',
        'exception' => 'array',
    ];

    public function failable()
    {
        return $this->morphTo();
    }
}

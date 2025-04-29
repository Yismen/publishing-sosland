<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailFail extends Model
{
    /** @use HasFactory<\Database\Factories\EmailFailFactory> */
    use HasFactory;

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
}

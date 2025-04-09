<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'date',
        'email',
        'campaign',
        'email_sent_at',
    ];

    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;
}

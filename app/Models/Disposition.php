<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disposition extends Model
{
    protected $fillable = ['name', 'is_mailable'];

    /** @use HasFactory<\Database\Factories\DispositionFactory> */
    use HasFactory;
}

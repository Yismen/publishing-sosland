<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    protected $fillable = ['name'];

    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory;
}

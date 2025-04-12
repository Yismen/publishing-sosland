<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\InteracstsWithModelCaching;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory;
    use InteracstsWithModelCaching;

    protected $fillable = ['name'];
}

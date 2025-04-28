<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use \App\Traits\Models\InteracstsWithModelCaching;

    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'banner_path',
        'website',
        'keywords',
        'keywords_operator',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    public function getKeywordsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setKeywordsAttribute($value)
    {
        $this->attributes['keywords'] = json_encode(
            explode(
                ',',
                str(
                    implode(',', (array) $value)
                )->lower()
            )
        );
    }
}

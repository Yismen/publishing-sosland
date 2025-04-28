<?php

namespace App\Services;

use App\Models\Campaign;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ItemNotFoundException;

class CampaignService
{
    public static function fromString(string $name): null|Campaign|ItemNotFoundException
    {
        return Cache::remember($name, now()->addMinutes(10), function () use ($name) {
            return Campaign::query()
                ->get()
                ->first(function ($campaign) use ($name) {
                    if (
                        $campaign->keywords_operator === '&'
                        && str($name)->lower()->containsAll(array_values($campaign->keywords), true)
                    ) {
                        return true;
                    }

                    if ($campaign->keywords_operator === '|') {
                        foreach ($campaign->keywords as $keyword) {
                            if (str($name)->lower()->contains($keyword, true)) {
                                return true;
                            }
                        }
                    }
                });
        });
    }
}

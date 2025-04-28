<?php

namespace App\Services;

use App\Models\Disposition;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class DispositionsService
{
    public static function get(): Collection
    {
        return Cache::remember('dispositions_list', now()->addHours(4), function () {
            return Disposition::query()
                ->orderBy('name')
                ->get();
        });
    }

    public static function getNames(): array
    {
        return self::get()->pluck('name')->toArray();
    }
}

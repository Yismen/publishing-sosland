<?php

namespace App\Rules;

use App\Models\Campaign;
use App\Services\CampaignService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Cache;

class ValidCampaign implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (CampaignService::fromString($value) instanceof Campaign) {
            return;
        }

        $fail('The :attribute is not a valid campaign.');
    }
}

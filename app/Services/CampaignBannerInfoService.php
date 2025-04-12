<?php

namespace App\Services;

use App\Models\Contact;

class CampaignBannerInfoService
{
    public static function getData(Contact $contact): array
    {
        $campaign = str($contact->campaign)->lower();

        if ($campaign->containsAll(['pet', 'food'])) {
            return [
                'banner_path' => asset('img/petfoodprocessing-logo.png'),
                'banner_url' => 'petfoodprocessing.net',
            ];
        }

        if ($campaign->containsAll(['food', 'business'])) {
            return [
                'banner_path' => asset('img/foodbusiness-logo.jpg'),
                'banner_url' => 'foodbusinessnews.net',
            ];
        }

        if ($campaign->contains('baking') || $campaign->contains('millin')) {
            return [
                'banner_path' => asset('img/millingandbaking-logo.jpg'),
                'banner_url' => 'bakingbusiness.net',
            ];
        }

        throw new \Exception("Campaign {$campaign} Invalid campaign");
    }
}

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
                'banner_url' => 'https://petfoodprocessing.net',
            ];
        }

        if ($campaign->containsAll(['food', 'business'])) {
            return [
                'banner_path' => asset('img/foodbusiness-logo.png'),
                'banner_url' => 'https://foodbusinessnews.net',
            ];
        }

        if ($campaign->contains('baking') || $campaign->contains('millin')) {
            return [
                'banner_path' => asset('img/millingandbaking-logo.jpg'),
                'banner_url' => 'https://bakingbusiness.com',
            ];
        }

        throw new \Exception("Campaign {$campaign} Invalid campaign");
    }
}

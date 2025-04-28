<?php

use App\Models\Campaign;
use App\Services\CampaignService;

it('finds the correct campaign when operator is appersand and all keywords are present', function () {
    $name = 'Some long name with keyword 1 and keyword 2 and a lot of other stuff';

    Campaign::factory()->count(3)->create();

    $campaign = Campaign::factory()->create([
        'name' => $name,
        'keywords_operator' => '&',
        'keywords' => ['keyword 1', 'keyword 2'],
    ]);

    expect(CampaignService::fromString($name)->id)
        ->toBe($campaign->id);
});

it('dont find any campaign when operator is appersand and not all keywords are present', function () {
    $name = 'Some long name with keyword 1 and a log of other stuff';

    Campaign::factory()->count(3)->create();

    Campaign::factory()->create([
        'name' => $name,
        'keywords_operator' => '&',
        'keywords' => ['keyword 1', 'keyword 2'],
    ]);

    expect(CampaignService::fromString($name))
        ->tobeNull();
});

it('return the campaign based on file name using any keyword', function () {
    $name = 'Some long name with just one keyword 1 and a lot of other stuff';

    Campaign::factory()->count(3)->create();

    $campaign = Campaign::factory()->create([
        'name' => $name,
        'keywords_operator' => '|',
        'keywords' => ['keyword 1', 'keyword 2'],
    ]);

    expect(CampaignService::fromString($name)->id)
        ->toBe($campaign->id);
});

it('return exception when there is not campaing with the name provided based on keywords', function () {
    $name = 'Some long name without correct keys and a lot of other stuff';

    Campaign::factory()->create([
        'name' => $name,
        'keywords_operator' => '|',
        'keywords' => ['keyword 1', 'keyword 2'],
    ]);

    expect(CampaignService::fromString($name))
        ->tobeNull();
});

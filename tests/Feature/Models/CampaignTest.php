<?php

use App\Models\Campaign;

it('save correct fields', function () {
    $data = Campaign::factory()->make();

    Campaign::create($data->toArray());

    $this->assertDatabaseHas(Campaign::class, $data->only([
        'name',
        'banner_path',
        'website',
        'keywords_operator',
        // 'keywords',
    ]));
});

it('save keywords as json', function () {
    $data = Campaign::factory()->make();

    Campaign::create($data->toArray());

    $this->assertDatabaseHas(Campaign::class, [
        'name' => $data->name,
        'banner_path' => $data->banner_path,
        'website' => $data->website,
        'keywords_operator' => $data->keywords_operator,
        'keywords' => json_encode($data->keywords),
    ]);
});

it('save keywords as array', function () {
    $data = Campaign::factory()->make();

    Campaign::create($data->toArray());

    $this->assertDatabaseHas(Campaign::class, [
        'name' => $data->name,
        'banner_path' => $data->banner_path,
        'website' => $data->website,
        'keywords_operator' => $data->keywords_operator,
        'keywords' => json_encode($data->keywords),
    ]);
});

it('save keywords as string', function () {
    $data = Campaign::factory()->make();

    Campaign::create($data->toArray());

    $this->assertDatabaseHas(Campaign::class, [
        'name' => $data->name,
        'banner_path' => $data->banner_path,
        'website' => $data->website,
        'keywords_operator' => $data->keywords_operator,
        'keywords' => json_encode($data->keywords),
    ]);
});

it('save keywords as string with spaces', function () {
    $data = Campaign::factory()->make();

    Campaign::create($data->toArray());

    $this->assertDatabaseHas(Campaign::class, [
        'name' => $data->name,
        'banner_path' => $data->banner_path,
        'website' => $data->website,
        'keywords_operator' => $data->keywords_operator,
        'keywords' => json_encode($data->keywords),
    ]);
});

it('save keywords as string with commas', function () {
    $data = Campaign::factory()->make();

    Campaign::create($data->toArray());

    $this->assertDatabaseHas(Campaign::class, [
        'name' => $data->name,
        'banner_path' => $data->banner_path,
        'website' => $data->website,
        'keywords_operator' => $data->keywords_operator,
        'keywords' => json_encode($data->keywords),
    ]);
});

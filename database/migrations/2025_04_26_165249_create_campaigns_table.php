<?php

use App\Models\Campaign;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('banner_path')->nullable();
            $table->string('website')->nullable();
            $table->string('keywords_operator')->default('&');
            $table->string('keywords')->nullable();
            $table->timestamps();
        });

        Campaign::create([
            'name' => 'Milling and Baking',
            'banner_path' => 'img/millingandbaking-logo.jpg',
            'website' => 'https://bakingbusiness.com',
            'keywords_operator' => '|',
            'keywords' => ['milling', 'baking'],
        ]);

        Campaign::create([
            'name' => 'Pet Food Processing',
            'banner_path' => 'img/petfoodprocessing-logo.png',
            'website' => 'https://petfoodprocessing.net',
            'keywords_operator' => '&',
            'keywords' => ['pet', 'food'],
        ]);

        Campaign::create([
            'name' => 'Food Business',
            'banner_path' => 'img/foodbusiness-logo.png',
            'website' => 'https://foodbusinessnews.net',
            'keywords_operator' => '&',
            'keywords' => ['food', 'business'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};

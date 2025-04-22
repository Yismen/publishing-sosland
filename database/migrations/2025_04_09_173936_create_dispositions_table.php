<?php

use App\Models\Disposition;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dispositions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_mailable');
            $table->timestamps();
        });

        Disposition::create(['name' => 'Complete', 'is_mailable' => true]);
        Disposition::create(['name' => 'Complete Replacement', 'is_mailable' => true]);
        Disposition::create(['name' => 'Complete With Referral', 'is_mailable' => true]);
        Disposition::create(['name' => 'Dual Dispo for Two Pubs', 'is_mailable' => true]);
        Disposition::create(['name' => 'Dual Dispo for Two Pubs With Referral', 'is_mailable' => true]);
        Disposition::create(['name' => 'Qual Dispo for Three Pubs', 'is_mailable' => true]);
        Disposition::create(['name' => 'Qual Dispo for Three Pubs With Referral', 'is_mailable' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositions');
    }
};

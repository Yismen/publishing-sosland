<?php

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
        Schema::create('email_fails', function (Blueprint $table) {
            $table->id();
            $table->timestamp('email_failed_at')->nullable();
            $table->unsignedBigInteger('failable_id')->nullable();
            $table->string('failable_type')->nullable();
            $table->json('data')->nullable();
            $table->json('exception')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_fails');
    }
};

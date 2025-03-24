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
        Schema::create('user_applies', function (Blueprint $table) {
            $table->id();
            $table->text('presentation');
            $table->string('userUrl');
            $table->string('nameFile');
            $table->string('pathFile');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('job_offer_id')->references('id')->on('job_offers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_applies');
    }
};

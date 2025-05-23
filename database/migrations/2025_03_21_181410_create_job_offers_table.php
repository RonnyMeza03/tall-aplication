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
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->boolean('isActive')->default(true);
            $table->string('jobTitle');
            $table->text('description');
            $table->decimal('minSalary', 10, 2);
            $table->decimal('maxSalary', 10, 2);
            $table->enum('mode', ['remote', 'on-site', 'hybrid']);
            $table->enum('workingHours', ['full-time', 'part-time', 'contract']);
            $table->string('currency');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('country_id')->references('id')->on('countries');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->dateTime('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offers');
    }
};

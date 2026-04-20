<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // (Commented out to prevent duplicate table creation)
        // Schema::create('survey_responses', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('survey_id')->constrained('surveys')->onDelete('cascade');
        //     $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        //     $table->json('meta')->nullable();
        //     $table->timestamps();
        // });
    }

    public function down(): void
    {
        // (Commented out to prevent accidental drop)
        // Schema::dropIfExists('survey_responses');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // (Commented out to prevent duplicate table creation)
        // Schema::create('survey_responses', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id');
        //     $table->unsignedBigInteger('survey_id')->nullable();
        //     $table->text('response');
        //     $table->timestamps();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });
    }

    public function down(): void
    {
        // (Commented out to prevent accidental drop)
        // Schema::dropIfExists('survey_responses');
    }
};

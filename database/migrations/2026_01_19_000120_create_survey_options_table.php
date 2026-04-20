<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('survey_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_question_id')->constrained('survey_questions')->onDelete('cascade');
            $table->string('label');
            $table->string('value')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_options');
    }
};

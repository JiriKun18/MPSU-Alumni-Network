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
        Schema::dropIfExists('alumni_records');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('alumni_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('normalized_name')->index();
            $table->timestamps();
        });
    }
};

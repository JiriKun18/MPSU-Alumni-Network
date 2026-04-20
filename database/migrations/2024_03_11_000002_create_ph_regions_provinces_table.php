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
        // Philippines Regions table
        Schema::create('ph_regions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // PSGC code
            $table->string('name');
            $table->timestamps();
            
            $table->index('code');
        });

        // Provinces table
        Schema::create('ph_provinces', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // PSGC code
            $table->string('name');
            $table->string('region_code');
            $table->timestamps();
            
            $table->index('region_code');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ph_provinces');
        Schema::dropIfExists('ph_regions');
    }
};

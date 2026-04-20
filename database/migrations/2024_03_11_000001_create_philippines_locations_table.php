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
        // Cities and Municipalities table
        Schema::create('ph_cities', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // PSGC code
            $table->string('name');
            $table->string('province_code');
            $table->timestamps();
            
            $table->index('province_code');
            $table->index('code');
        });

        // Barangays table
        Schema::create('ph_barangays', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // PSGC code
            $table->string('name');
            $table->string('city_code');
            $table->timestamps();
            
            $table->index('city_code');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ph_barangays');
        Schema::dropIfExists('ph_cities');
    }
};

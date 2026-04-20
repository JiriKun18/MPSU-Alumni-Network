<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->string('present_region')->nullable()->after('present_country');
            $table->string('present_province')->nullable()->after('present_region');
            $table->string('present_city')->nullable()->after('present_province');
            $table->string('present_barangay')->nullable()->after('present_city');
            $table->string('permanent_region')->nullable()->after('permanent_country');
            $table->string('permanent_province')->nullable()->after('permanent_region');
            $table->string('permanent_city')->nullable()->after('permanent_province');
            $table->string('permanent_barangay')->nullable()->after('permanent_city');
        });
    }

    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'present_region',
                'present_province',
                'present_city',
                'present_barangay',
                'permanent_region',
                'permanent_province',
                'permanent_city',
                'permanent_barangay',
            ]);
        });
    }
};

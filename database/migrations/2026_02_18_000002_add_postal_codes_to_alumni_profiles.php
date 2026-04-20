<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->string('present_postal_code', 20)->nullable()->after('present_address');
            $table->string('permanent_postal_code', 20)->nullable()->after('permanent_address');
        });
    }

    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn(['present_postal_code', 'permanent_postal_code']);
        });
    }
};

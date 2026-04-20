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
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_number')->nullable()->after('email');
        });

        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->string('campus')->nullable()->after('batch_id');
            $table->string('course_graduated')->nullable()->after('campus');
            $table->integer('year_graduated')->nullable()->after('course_graduated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('contact_number');
        });

        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn(['campus', 'course_graduated', 'year_graduated']);
        });
    }
};

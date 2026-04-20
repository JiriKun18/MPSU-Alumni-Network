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
        Schema::table('otps', function (Blueprint $table) {
            // Add email column if it doesn't exist
            if (!Schema::hasColumn('otps', 'email')) {
                $table->string('email')->nullable()->after('id');
            }
            
            // Drop phone column if it exists
            if (Schema::hasColumn('otps', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('otps', function (Blueprint $table) {
            // Add phone column back if it doesn't exist
            if (!Schema::hasColumn('otps', 'phone')) {
                $table->string('phone')->nullable()->after('id');
            }
            
            // Drop email column if it exists
            if (Schema::hasColumn('otps', 'email')) {
                $table->dropColumn('email');
            }
        });
    }
};

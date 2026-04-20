<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->string('proof_of_employment')->nullable()->after('company_address');
        });
    }

    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn('proof_of_employment');
        });
    }
};

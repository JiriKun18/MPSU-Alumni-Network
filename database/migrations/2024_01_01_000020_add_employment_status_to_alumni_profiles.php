<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmploymentStatusToAlumniProfiles extends Migration
{
    public function up()
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->enum('employment_status', ['employed', 'unemployed', 'self-employed', 'contractual'])->nullable()->after('current_company');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employment_status');
    }
}

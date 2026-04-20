<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropStudentIdFromAlumniProfiles extends Migration
{
    public function up()
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn('student_id');
        });
    }

    public function down()
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->string('student_id')->nullable()->unique();
        });
    }
}

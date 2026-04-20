<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('alumni_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('batch_id')->nullable()->constrained('batches')->onDelete('set null');
            $table->string('student_id')->unique();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('current_position')->nullable();
            $table->string('current_company')->nullable();
            $table->string('profile_picture')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('course')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alumni_profiles');
    }
}

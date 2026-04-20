<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostingsTable extends Migration
{
    public function up()
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('company_name');
            $table->string('position_type'); // Full-time, Part-time, Contract
            $table->string('location');
            $table->decimal('salary_min', 12, 2)->nullable();
            $table->decimal('salary_max', 12, 2)->nullable();
            $table->text('requirements')->nullable();
            $table->date('deadline');
            $table->boolean('is_active')->default(true);
            $table->foreignId('posted_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_postings');
    }
}

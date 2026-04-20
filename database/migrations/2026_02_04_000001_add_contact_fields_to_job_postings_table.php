<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_website')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('approval_status')->default('pending');
        });
    }

    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_email',
                'contact_phone',
                'contact_website',
                'contact_address',
                'approval_status',
            ]);
        });
    }
};

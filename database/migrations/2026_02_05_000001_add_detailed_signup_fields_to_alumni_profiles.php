<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            // Name fields
            $table->string('family_name')->nullable()->after('user_id');
            $table->string('given_name')->nullable()->after('family_name');
            $table->string('middle_initial', 10)->nullable()->after('given_name');
            $table->string('suffix', 10)->nullable()->after('middle_initial');
            $table->string('sex', 10)->nullable()->after('suffix');
            
            // Address fields
            $table->string('present_country')->nullable()->after('province');
            $table->string('present_address')->nullable()->after('present_country');
            $table->string('same_as_present', 10)->nullable()->after('present_address');
            $table->string('permanent_country')->nullable()->after('same_as_present');
            $table->string('permanent_address')->nullable()->after('permanent_country');
            
            // Occupation fields
            $table->string('occupation_type')->nullable()->after('permanent_address');
            $table->string('employment_type')->nullable()->after('occupation_type');
            $table->string('job_position')->nullable()->after('employment_type');
            $table->string('company_name')->nullable()->after('job_position');
            $table->string('company_country')->nullable()->after('company_name');
            $table->string('company_address')->nullable()->after('company_country');
            
            // Student ID
            $table->string('student_id')->nullable()->after('company_address');
        });
    }

    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'family_name',
                'given_name',
                'middle_initial',
                'suffix',
                'sex',
                'present_country',
                'present_address',
                'same_as_present',
                'permanent_country',
                'permanent_address',
                'occupation_type',
                'employment_type',
                'job_position',
                'company_name',
                'company_country',
                'company_address',
                'student_id',
            ]);
        });
    }
};

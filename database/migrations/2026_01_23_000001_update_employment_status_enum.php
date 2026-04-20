<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateEmploymentStatusEnum extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE `alumni_profiles` MODIFY COLUMN `employment_status` ENUM('employed', 'unemployed', 'self-employed', 'contractual', 'permanent', 'temporary') NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE `alumni_profiles` MODIFY COLUMN `employment_status` ENUM('employed', 'unemployed', 'self-employed', 'contractual') NULL");
    }
}

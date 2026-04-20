<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrivacySettingsToAlumniProfiles extends Migration
{
    public function up()
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            // Privacy control columns - default to true (visible) for existing records
            $table->boolean('show_email')->default(true)->after('profile_picture');
            $table->boolean('show_phone')->default(true)->after('show_email');
            $table->boolean('show_birthdate')->default(true)->after('show_phone');
            $table->boolean('show_present_address')->default(true)->after('show_birthdate');
            $table->boolean('show_permanent_address')->default(true)->after('show_present_address');
            $table->boolean('show_occupation')->default(true)->after('show_permanent_address');
        });
    }

    public function down()
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'show_email',
                'show_phone',
                'show_birthdate',
                'show_present_address',
                'show_permanent_address',
                'show_occupation'
            ]);
        });
    }
}

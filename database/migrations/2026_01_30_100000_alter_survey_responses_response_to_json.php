<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add new json column
        Schema::table('survey_responses', function (Blueprint $table) {
            $table->json('response_tmp')->nullable();
        });

        // 2. Copy data from old response to response_tmp (if old column exists)
        if (Schema::hasColumn('survey_responses', 'response')) {
            $responses = DB::table('survey_responses')->get();
            foreach ($responses as $resp) {
                $val = $resp->response;
                $json = @json_decode($val, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
                    DB::table('survey_responses')->where('id', $resp->id)->update(['response_tmp' => $val]);
                } else {
                    $arr = @unserialize($val);
                    if ($arr !== false && is_array($arr)) {
                        DB::table('survey_responses')->where('id', $resp->id)->update(['response_tmp' => json_encode($arr)]);
                    } else {
                        DB::table('survey_responses')->where('id', $resp->id)->update(['response_tmp' => json_encode(['value' => $val])]);
                    }
                }
            }
            // 3. Drop old response column
            Schema::table('survey_responses', function (Blueprint $table) {
                $table->dropColumn('response');
            });
        }
        // 4. Rename new column
        Schema::table('survey_responses', function (Blueprint $table) {
            $table->renameColumn('response_tmp', 'response');
        });
    }

    public function down(): void
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            $table->text('response')->nullable();
        });
        // No data migration back
        Schema::table('survey_responses', function (Blueprint $table) {
            $table->dropColumn('response');
        });
    }
};

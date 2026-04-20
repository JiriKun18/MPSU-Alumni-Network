<?php

namespace App\Console\Commands;

use App\Models\Survey;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveBuiltinSurvey extends Command
{
    protected $signature = 'surveys:remove-builtin {--title=Graduate Alumni Survey 2026}';
    protected $description = 'Remove the built-in seeded survey and its related records.';

    public function handle(): int
    {
        $title = trim((string) $this->option('title'));

        if ($title === '') {
            $this->error('Survey title cannot be empty.');
            return Command::FAILURE;
        }

        $survey = Survey::where('title', $title)->first();

        if (!$survey) {
            $this->info("No survey found with title: {$title}");
            return Command::SUCCESS;
        }

        DB::transaction(function () use ($survey) {
            $survey->questions()->each(function ($question) {
                $question->options()->delete();
                $question->delete();
            });

            $survey->responses()->each(function ($response) {
                $response->answers()->delete();
                $response->delete();
            });

            $survey->delete();
        });

        $this->info("Removed survey and related records: {$title}");

        return Command::SUCCESS;
    }
}

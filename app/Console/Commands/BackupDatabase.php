<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Symfony\Component\Process\Process;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database to a SQL file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting database backup...');

        try {
            $fileName = 'backups/alumni_backup_' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
            $backupPath = storage_path($fileName);

            // Ensure backup directory exists
            @mkdir(dirname($backupPath), 0755, true);

            $connection = config('database.default');
            $config = config("database.connections.$connection");

            if (($config['driver'] ?? null) !== 'mysql') {
                $this->error('✗ Backup only supports MySQL connections.');
                return 1;
            }

            $dbName = $config['database'] ?? '';
            $dbUser = $config['username'] ?? '';
            $dbPass = $config['password'] ?? '';
            $dbHost = $config['host'] ?? 'localhost';

            $commandParts = [
                'mysqldump',
                '--host=' . escapeshellarg($dbHost),
                '--user=' . escapeshellarg($dbUser),
            ];

            if ($dbPass !== null && $dbPass !== '') {
                $commandParts[] = '--password=' . escapeshellarg($dbPass);
            }

            $commandParts[] = escapeshellarg($dbName);
            $commandParts[] = '>';
            $commandParts[] = escapeshellarg($backupPath);

            $command = implode(' ', $commandParts);

            $process = Process::fromShellCommandline($command);
            $process->setTimeout(300);
            $process->run();

            if ($process->isSuccessful() && file_exists($backupPath) && filesize($backupPath) > 0) {
                $fileSize = formatBytes(filesize($backupPath));
                $this->info("✓ Database backed up successfully!");
                $this->info("Location: $fileName");
                $this->info("Size: $fileSize");

                // Clean up old backups (keep only last 30 days)
                $this->cleanOldBackups();

                return 0;
            } else {
                $errorOutput = trim($process->getErrorOutput() ?: $process->getOutput());
                if (file_exists($backupPath) && filesize($backupPath) === 0) {
                    @unlink($backupPath);
                }
                $this->error('✗ Failed to create database backup');
                if ($errorOutput !== '') {
                    $this->error($errorOutput);
                }
                return 1;
            }
        } catch (\Exception $e) {
            $this->error('✗ Error during backup: ' . $e->getMessage());
            return 1;
        }
    }

    /**
     * Clean up backups older than 30 days
     */
    private function cleanOldBackups()
    {
        $backupDir = storage_path('backups');

        if (!is_dir($backupDir)) {
            return;
        }

        $files = scandir($backupDir);
        $thirtyDaysAgo = time() - (30 * 24 * 60 * 60);

        foreach ($files as $file) {
            $filePath = $backupDir . '/' . $file;
            if (is_file($filePath) && filemtime($filePath) < $thirtyDaysAgo) {
                unlink($filePath);
                $this->info("Cleaned old backup: $file");
            }
        }
    }
}

/**
 * Format bytes to human readable format
 */
if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

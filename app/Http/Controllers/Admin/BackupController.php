<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
    /**
     * List all backups
     */
    public function index()
    {
        $backupDir = storage_path('backups');
        $backups = [];

        if (is_dir($backupDir)) {
            $files = scandir($backupDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && strpos($file, 'alumni_backup_') === 0) {
                    $filePath = $backupDir . '/' . $file;
                    $backups[] = [
                        'path' => $filePath,
                        'filename' => $file,
                        'date' => Carbon::createFromTimestamp(filemtime($filePath))->format('M d, Y h:i A'),
                        'size' => $this->formatBytes(filesize($filePath))
                    ];
                }
            }
            // Sort by date descending
            usort($backups, function ($a, $b) {
                return filemtime($b['path']) - filemtime($a['path']);
            });
        }

        return view('admin.backups.index', compact('backups'));
    }

    /**
     * Create backup immediately
     */
    public function create()
    {
        try {
            Artisan::call('backup:database');
            return redirect()->route('admin.backups.index')->with('success', 'Backup created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.backups.index')->with('error', 'Failed to create backup: ' . $e->getMessage());
        }
    }

    /**
     * Download a backup file
     */
    public function download($filename)
    {
        $backupDir = storage_path('backups');
        $filePath = $backupDir . '/' . basename($filename);

        if (!file_exists($filePath)) {
            abort(404, 'Backup file not found');
        }

        return response()->download($filePath, $filename, [
            'Content-Type' => 'application/octet-stream',
        ]);
    }

    /**
     * Delete a backup file
     */
    public function delete($filename)
    {
        $backupDir = storage_path('backups');
        $filePath = $backupDir . '/' . basename($filename);

        if (!file_exists($filePath)) {
            return response()->json(['success' => false, 'message' => 'File not found'], 404);
        }

        try {
            unlink($filePath);
            return response()->json(['success' => true, 'message' => 'Backup deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

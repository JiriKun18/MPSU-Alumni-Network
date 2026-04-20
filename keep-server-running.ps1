# Persistent Server Monitor - Keeps PHP running
# Run this script in PowerShell with admin privileges
# Network access enabled via 0.0.0.0:8000 (accessible from other devices)

$logFile = "C:\laragon\www\alumni system\server-monitor.log"
$appPath = "c:\laragon\www\alumni system"
$phpExe = "C:\laragon\bin\php\php-8.3.28-Win32-vs16-x64\php.exe"

function Log-Message {
    param([string]$Message)
    $timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
    $logEntry = "[$timestamp] $Message"
    Add-Content -Path $logFile -Value $logEntry
    Write-Host $logEntry
}

function Start-PHPServer {
    Log-Message "Starting PHP server on port 8000 (accessible from network)..."
    $process = Start-Process -FilePath $phpExe `
        -ArgumentList "artisan", "serve", "--host=0.0.0.0", "--port=8000" `
        -WorkingDirectory $appPath `
        -PassThru `
        -WindowStyle Hidden `
        -RedirectStandardOutput "$appPath\php-server.log" `
        -RedirectStandardError "$appPath\php-error.log"
    Log-Message "PHP server started with PID: $($process.Id)"
    return $process.Id
}

# Clear old logs
Clear-Content -Path $logFile -ErrorAction SilentlyContinue
Log-Message "=========================================="
Log-Message "Alumni System - Server Monitor (Network Edition)"
Log-Message "=========================================="

# Kill any existing PHP processes
Log-Message "Cleaning up existing processes..."
Get-Process php -ErrorAction SilentlyContinue | Stop-Process -Force
Start-Sleep -Seconds 2

# Clear caches before starting
Log-Message "Clearing application caches..."
cd $appPath
& $phpExe artisan config:clear
& $phpExe artisan cache:clear
& $phpExe artisan view:clear

# Start PHP server
$phpPID = Start-PHPServer

Start-Sleep -Seconds 3

Log-Message "Server started. Monitoring every 30 seconds..."
Log-Message "Press Ctrl+C to stop monitoring (service will continue running in background)"

# Monitor loop
$checkInterval = 30
$failureCount = 0

while ($true) {
    try {
        # Check PHP server
        $phpProcess = Get-Process -Id $phpPID -ErrorAction SilentlyContinue
        if ($null -eq $phpProcess -or $phpProcess.HasExited) {
            Log-Message "ERROR: PHP server crashed! Restarting..."
            $phpPID = Start-PHPServer
            $failureCount++
            Start-Sleep -Seconds 3
        } else {
            $failureCount = 0
        }
        
        # If too many failures, stop and alert
        if ($failureCount -gt 5) {
            Log-Message "CRITICAL: Multiple failures detected. Check error logs."
            Write-Host "CRITICAL ERROR: Server keep crashing. Check the error logs." -ForegroundColor Red
            break
        }
        
        Start-Sleep -Seconds $checkInterval
    }
    catch {
        Log-Message "Error in monitoring loop: $_"
        Start-Sleep -Seconds 5
    }
}

Log-Message "Monitoring stopped."

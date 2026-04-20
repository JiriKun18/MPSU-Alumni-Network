@echo off
echo ========================================
echo MPSU Alumni - Laragon Fix Tool
echo ========================================
echo.

echo This will fix common Laragon issues
echo.

echo [Step 1] Stopping all running processes...
echo ------------------------------------
taskkill /F /IM httpd.exe >nul 2>&1
taskkill /F /IM mysqld.exe >nul 2>&1
taskkill /F /IM nginx.exe >nul 2>&1
echo Stopped Apache and MySQL processes
timeout /t 2 >nul
echo.

echo [Step 2] Checking for port conflicts...
echo ------------------------------------
echo Checking Port 80 (Apache)...
netstat -ano | findstr ":80 " | findstr "LISTENING"
echo.
echo Checking Port 3306 (MySQL)...
netstat -ano | findstr ":3306 " | findstr "LISTENING"
echo.

echo [Step 3] What to do next:
echo ------------------------------------
echo Option 1: Try starting Laragon again
echo   - Open Laragon
echo   - Click "Start All"
echo.
echo Option 2: If Laragon won't open:
echo   - Right-click Laragon icon in system tray (bottom-right)
echo   - Click "Quit"
echo   - Open Laragon again from Start menu
echo.
echo Option 3: If port conflict exists:
echo   - Stop other web servers (XAMPP, WAMP, IIS)
echo   - Or change Laragon port in: Menu ^> Preferences
echo.
echo Option 4: Complete Reset:
echo   - Close Laragon completely
echo   - Restart your computer
echo   - Start Laragon fresh
echo.
echo ========================================
echo.
pause

echo.
echo Do you want to try starting Laragon now? (y/n)
set /p start="Enter choice: "
if /i "%start%"=="y" (
    echo Starting Laragon...
    start "" "C:\laragon\laragon.exe"
    echo.
    echo If Laragon doesn't start, try restarting your computer.
)
echo.
pause

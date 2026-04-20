@echo off
echo ========================================
echo MPSU Alumni System - IP Address Finder
echo ========================================
echo.

echo Your Local IP Addresses:
echo ------------------------------------
for /f "tokens=2 delims=:" %%a in ('ipconfig ^| findstr /c:"IPv4 Address"') do (
    set ip=%%a
    setlocal enabledelayedexpansion
    echo !ip!
    endlocal
)

echo.
echo ------------------------------------
echo Use one of the IP addresses above to access from other devices
echo.
echo Example: http://192.168.1.100
echo.
echo Make sure other devices are on the SAME WiFi network!
echo.
pause

@echo off
echo ========================================
echo MPSU Alumni - Enable Network Access
echo ========================================
echo.

echo This script will help you enable network access for the MPSU Alumni System
echo.

echo STEP 1: Finding Your IP Address
echo ------------------------------------
echo Your computer's IP addresses:
echo.
ipconfig | findstr /i "IPv4"
echo.
echo Copy one of the IPv4 addresses shown above (e.g., 192.168.1.100)
echo.
pause

echo.
echo STEP 2: Configure Windows Firewall
echo ------------------------------------
echo Checking if running as Administrator...
net session >nul 2>&1
if %errorLevel% == 0 (
    echo Running as Administrator - Good!
    echo.
    echo Adding firewall rule for Apache...
    netsh advfirewall firewall add rule name="Laragon Apache HTTP" dir=in action=allow protocol=TCP localport=80
    echo Firewall rule added successfully!
) else (
    echo WARNING: Not running as Administrator
    echo Please run this script as Administrator to configure firewall
    echo Or manually add Apache to Windows Firewall exceptions
)

echo.
echo STEP 3: Test Network Access
echo ------------------------------------
echo.
echo To access from other devices:
echo 1. Make sure the other device is on the SAME WiFi network
echo 2. On the other device, open a web browser
echo 3. Type: http://YOUR_IP_ADDRESS
echo    (Replace YOUR_IP_ADDRESS with the IP shown above)
echo.
echo Example: If your IP is 192.168.1.100, type:
echo    http://192.168.1.100
echo.

echo STEP 4: Update .env Configuration (Optional)
echo ------------------------------------
set /p updateEnv="Do you want to update .env with your IP? (y/n): "
if /i "%updateEnv%"=="y" (
    set /p ipAddress="Enter your IP address (e.g., 192.168.1.100): "
    if exist .env (
        powershell -Command "(Get-Content .env) -replace 'APP_URL=.*', 'APP_URL=http://%ipAddress%' | Set-Content .env"
        echo Updated APP_URL in .env to http://%ipAddress%
    ) else (
        echo .env file not found
    )
)

echo.
echo ========================================
echo Network Access Setup Complete!
echo ========================================
echo.
echo Next Steps:
echo 1. Restart Laragon (Stop All, then Start All)
echo 2. Test on your computer: http://mpsu-alumni.test
echo 3. Test from another device: http://YOUR_IP_ADDRESS
echo.
echo Troubleshooting:
echo - Make sure both devices are on the same WiFi
echo - Check Windows Firewall allows Apache
echo - Try temporarily disabling antivirus
echo.
pause

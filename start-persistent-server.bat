@echo off
REM Start the persistent server monitor
powershell -NoProfile -ExecutionPolicy Bypass -Command "& 'c:\laragon\www\alumni system\keep-server-running.ps1'"
pause

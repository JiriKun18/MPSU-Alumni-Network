@echo off
REM MPSU Alumni System Installation Script for Windows

echo ==========================================
echo MPSU Alumni Management System
echo Installation Script for Windows
echo ==========================================
echo.

REM Check if Composer is installed
where composer >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ Composer is not installed. Please install Composer first.
    exit /b 1
)

REM Check if PHP is installed
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo ❌ PHP is not installed. Please install PHP 8.0 or higher.
    exit /b 1
)

echo ✅ Prerequisites checked
echo.

REM Step 1: Install PHP dependencies
echo 📦 Installing PHP dependencies...
call composer install --no-interaction
if %errorlevel% neq 0 (
    echo ❌ Failed to install PHP dependencies
    exit /b 1
)
echo ✅ PHP dependencies installed
echo.

REM Step 2: Copy environment file
if not exist .env (
    echo 📝 Creating .env file...
    copy .env.example .env
    echo ✅ .env file created
) else (
    echo ℹ️  .env file already exists
)
echo.

REM Step 3: Generate application key
echo 🔑 Generating application key...
call php artisan key:generate
echo ✅ Application key generated
echo.

REM Step 4: Create storage link
echo 🔗 Creating storage link...
call php artisan storage:link 2>nul
echo ✅ Storage link created
echo.

REM Step 5: Install Node.js dependencies and build assets
where npm >nul 2>nul
if %errorlevel% equ 0 (
    echo 📦 Installing Node.js dependencies...
    call npm install
    echo ✅ Node.js dependencies installed
    echo.

    echo 🎨 Building frontend assets...
    call npm run dev
    echo ✅ Frontend assets built
    echo.
)

REM Step 6: Database migration prompt
echo ==========================================
echo Database Setup
echo ==========================================
echo.
echo Before running migrations, ensure:
echo 1. MariaDB/MySQL is running
echo 2. Database credentials are set in .env file
echo.
set /p db_configured="Have you configured the database in .env? (y/n): "

if /i "%db_configured%"=="y" (
    echo 🗄️  Running database migrations...
    call php artisan migrate --seed
    if %errorlevel% equ 0 (
        echo ✅ Database migrations completed
        echo.
        echo ==========================================
        echo Installation Complete! 🎉
        echo ==========================================
        echo.
        echo Next steps:
        echo 1. Start the development server:
        echo    php artisan serve
        echo.
        echo 2. Access the application at:
        echo    http://localhost:8000
        echo.
        echo Default credentials:
        echo Admin:  admin@mpsu.edu / admin@123456
        echo Alumni: alumni1@mpsu.edu / alumni@123456
        echo.
    ) else (
        echo ⚠️  Database migration failed. Please check your database configuration.
    )
) else (
    echo ⚠️  Please configure your database in .env and run:
    echo    php artisan migrate --seed
)

pause

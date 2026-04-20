#!/bin/bash

# MPSU Alumni System Installation Script

echo "=========================================="
echo "MPSU Alumni Management System"
echo "Installation Script"
echo "=========================================="
echo ""

# Check if Composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer first."
    exit 1
fi

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.0 or higher."
    exit 1
fi

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "⚠️  Node.js is not installed. Some frontend features may not work."
fi

echo "✅ Prerequisites checked"
echo ""

# Step 1: Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-interaction
if [ $? -ne 0 ]; then
    echo "❌ Failed to install PHP dependencies"
    exit 1
fi
echo "✅ PHP dependencies installed"
echo ""

# Step 2: Copy environment file
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
    echo "✅ .env file created"
else
    echo "ℹ️  .env file already exists"
fi
echo ""

# Step 3: Generate application key
echo "🔑 Generating application key..."
php artisan key:generate
echo "✅ Application key generated"
echo ""

# Step 4: Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link 2>/dev/null || true
echo "✅ Storage link created"
echo ""

# Step 5: Install Node.js dependencies and build assets
if command -v npm &> /dev/null; then
    echo "📦 Installing Node.js dependencies..."
    npm install
    echo "✅ Node.js dependencies installed"
    echo ""

    echo "🎨 Building frontend assets..."
    npm run dev
    echo "✅ Frontend assets built"
    echo ""
fi

# Step 6: Database migration prompt
echo "=========================================="
echo "Database Setup"
echo "=========================================="
echo ""
echo "Before running migrations, ensure:"
echo "1. MariaDB/MySQL is running"
echo "2. Database credentials are set in .env file"
echo ""
read -p "Have you configured the database in .env? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "🗄️  Running database migrations..."
    php artisan migrate --seed
    if [ $? -eq 0 ]; then
        echo "✅ Database migrations completed"
        echo ""
        echo "=========================================="
        echo "Installation Complete! 🎉"
        echo "=========================================="
        echo ""
        echo "Next steps:"
        echo "1. Start the development server:"
        echo "   php artisan serve"
        echo ""
        echo "2. Access the application at:"
        echo "   http://localhost:8000"
        echo ""
        echo "Default credentials:"
        echo "Admin:  admin@mpsu.edu / admin@123456"
        echo "Alumni: alumni1@mpsu.edu / alumni@123456"
        echo ""
    else
        echo "⚠️  Database migration failed. Please check your database configuration."
    fi
else
    echo "⚠️  Please configure your database in .env and run:"
    echo "   php artisan migrate --seed"
fi

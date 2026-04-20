# MPSU Alumni Management System

A comprehensive Alumni Management System for Mountain Province State University built with Laravel, PHP, and MariaDB.

## Features

### Alumni Features

- User registration and authentication
- Complete profile management with profile picture
- Alumni directory search and filtering
- Job posting browsing and applications
- Event registrations and attendance tracking
- Alumni news feed and announcements
- Message/notification system
- Batch management by graduation year

### Administrator Features

- Alumni account management and verification
- Job posting management
- Event management
- News and announcements posting
- User role management
- System analytics and reporting
- Alumni statistics and insights
- Batch management

## System Requirements

- PHP >= 8.0
- Composer
- MariaDB/MySQL >= 5.7
- Node.js & npm (for frontend assets)
- Git

## Installation

### 1. Clone and Setup

```bash
cd /path/to/alumni-system
composer install
npm install
```

### 2. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file and configure your MariaDB connection:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mpsu_alumni
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### 4. Create Storage Link

```bash
php artisan storage:link
```

### 5. Build Frontend Assets

```bash
npm run dev
```

### 6. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Credentials

### Administrator

- **Email**: admin@mpsu.edu
- **Password**: admin@123456

### Sample Alumni

- **Email**: alumni@mpsu.edu
- **Password**: alumni@123456

> Change these credentials immediately after first login!

## Project Structure

```txt
├── app/
│   ├── Models/           # Eloquent models
│   ├── Controllers/      # Application controllers
│   ├── Http/            # Middleware and request validation
│   └── Providers/       # Service providers
├── database/
│   ├── migrations/      # Database migrations
│   └── seeders/        # Database seeders
├── resources/
│   ├── views/          # Blade templates
│   ├── css/           # Stylesheets
│   └── js/            # JavaScript files
├── routes/
│   ├── web.php         # Web routes
│   └── api.php         # API routes
├── config/             # Configuration files
└── public/             # Publicly accessible files
```

## Database Schema

### Tables

- `users` - User accounts (Alumni and Admin)
- `alumni_profiles` - Alumni profile information
- `batches` - Graduation batches/years
- `job_postings` - Job listings by employers
- `job_applications` - Alumni job applications
- `events` - University events
- `event_registrations` - Alumni event registrations
- `news` - News and announcements
- `messages` - Internal messaging system
- `notifications` - User notifications

## Usage

### For Alumni

1. Register with your university email
2. Complete your profile information
3. Upload profile picture
4. Browse alumni directory
5. Apply for job postings
6. Register for events
7. View announcements and news

### For Administrators

1. Login with admin credentials
2. Navigate to admin dashboard
3. Manage alumni accounts
4. Post job openings and events
5. Post news and announcements
6. View system reports and analytics

## Technologies Used

- **Backend**: Laravel 9.x, PHP 8.0+
- **Database**: MariaDB
- **Frontend**: Bootstrap 5, Blade Templates
- **Authentication**: Laravel Sanctum
- **Validation**: Laravel Validation
- **Mail**: Laravel Mail

## Troubleshooting

### Database Connection Error

- Verify MariaDB is running
- Check `.env` database credentials
- Ensure database `mpsu_alumni` exists

### Permission Denied Errors

```bash
chmod -R 775 storage bootstrap/cache
### Missing Application Key

```bash
php artisan key:generate
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## Support

For issues or questions, please contact the IT department.

## License

Proprietary - Mountain Province State University

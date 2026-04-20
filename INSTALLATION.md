# MPSU Alumni Management System - Installation & Setup Guide

## Overview

The MPSU Alumni Management System is a comprehensive web application built with Laravel, PHP, and MariaDB designed specifically for Mountain Province State University. The system manages alumni records, job postings, events, and announcements with two distinct user roles: Alumni and Administrator.

## System Requirements

### Server Requirements

- **PHP**: 8.0 or higher
- **Composer**: Latest version
- **MariaDB/MySQL**: 5.7 or higher
- **Node.js**: 14.0 or higher (for asset compilation)
- **npm**: 6.0 or higher

### Browser Requirements

- Modern browser (Chrome, Firefox, Safari, Edge)
- JavaScript enabled
- Cookies enabled

## Installation Steps

### 1. Download/Clone the Project

```bash
# Navigate to your desired directory
cd path/to/your/projects

# Clone or extract the project
git clone <repository-url> mpsu-alumni
cd mpsu-alumni
```

### 2. Install Dependencies

#### On Windows

Double-click `install.bat`

#### On Linux/Mac

```bash
bash install.sh
```

#### Manual Installation

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Configure Database

Edit the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mpsu_alumni
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Run Migrations and Seeders

```bash
# Create database tables
php artisan migrate

# Seed sample data
php artisan db:seed
```

### 5. Create Storage Link

```bash
php artisan storage:link
```

### 6. Build Frontend Assets

```bash
npm run dev

# Or for production:
npm run production
```

### 7. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Credentials

| Role  | Email            | Password     | Notes             |
|-------|------------------|--------------|-------------------|
| Admin | admin@mpsu.edu   | admin@123456 | Full system access |
| Alumni | alumni1@mpsu.edu | alumni@123456 | Alumni account     |
| Alumni | alumni2@mpsu.edu | alumni@123456 | Alumni account     |

**⚠️ IMPORTANT**: Change these credentials immediately after first login!

## Project Structure

```
mpsu-alumni/
├── app/
│   ├── Models/              # Database models
│   ├── Http/
│   │   ├── Controllers/     # Application controllers
│   │   └── Middleware/      # HTTP middleware
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript files
├── routes/
│   └── web.php              # Web routes
├── config/                  # Configuration files
├── public/                  # Publicly accessible files
├── storage/                 # File storage
└── bootstrap/               # Framework bootstrap
```

## Database Schema

### Core Tables

#### `users`

- id (Primary Key)
- name (String)
- email (Unique String)
- password (Hashed)
- role (enum: 'alumni', 'admin')
- is_active (Boolean)
- is_verified (Boolean)
- timestamps

#### `alumni_profiles`

- id (Primary Key)
- user_id (Foreign Key → users)
- batch_id (Foreign Key → batches)
- student_id (Unique String)
- phone, bio, address, city, province
- current_position, current_company
- profile_picture, date_of_birth, gender
- course, linkedin_url, facebook_url
- timestamps

#### `batches`

- id (Primary Key)
- year (Integer)
- description, notes (Text)
- timestamps

#### `job_postings`

- id (Primary Key)
- title, description (String/Text)
- company_name, position_type, location
- salary_min, salary_max (Decimal)
- requirements (Text)
- deadline (Date)
- is_active (Boolean)
- posted_by (Foreign Key → users)
- timestamps

#### `job_applications`

- id (Primary Key)
- alumni_id (Foreign Key → users)
- job_posting_id (Foreign Key → job_postings)
- cover_letter (Text)
- cv_file (String - path)
- status (enum: pending, reviewed, approved, rejected)
- admin_notes (Text)
- timestamps

#### `events`

- id (Primary Key)
- title, description, venue (String/Text)
- event_date (DateTime)
- event_time (String)
- max_attendees (Integer)
- status (String: upcoming, ongoing, completed, cancelled)
- image (String - path)
- created_by (Foreign Key → users)
- timestamps

#### `event_registrations`

- id (Primary Key)
- alumni_id (Foreign Key → users)
- event_id (Foreign Key → events)
- status (enum: registered, attended, cancelled)
- additional_info (Text)
- timestamps

#### `news`

- id (Primary Key)
- title (String)
- content (Text)
- featured_image (String - path)
- is_published (Boolean)
- published_at (DateTime)
- posted_by (Foreign Key → users)
- timestamps

#### `messages`

- id (Primary Key)
- sender_id (Foreign Key → users)
- recipient_id (Foreign Key → users)
- message (Text)
- is_read (Boolean)
- read_at (DateTime)
- timestamps

#### `notifications`

- id (Primary Key)
- user_id (Foreign Key → users)
- title, message (String/Text)
- type (String: job_application, event, news, message)
- is_read (Boolean)
- read_at (DateTime)
- timestamps

## User Roles & Permissions

### Alumni Role

- Create and edit personal profile
- Upload profile picture
- Browse alumni directory
- Apply for job postings
- Register for events
- View news and announcements
- Receive notifications

### Admin Role

- Manage all alumni accounts
- Verify/deactivate alumni accounts
- Create and manage job postings
- Review job applications
- Create and manage events
- Create and manage news/announcements
- View system statistics
- Manage system settings

## Features by Module

### 1. Authentication & Authorization

- User registration and login
- Role-based access control
- Password management
- Email verification

### 2. Alumni Management

- Complete profile management
- Profile picture upload
- Batch/graduation year tracking
- Alumni directory with search
- Profile visibility settings

### 3. Job Management

- Job posting creation and editing
- Application management
- CV upload and download
- Application status tracking
- Salary range display

### 4. Event Management

- Event creation and scheduling
- Event registration
- Attendance tracking
- Event image upload
- Capacity management

### 5. News & Announcements

- News article publishing
- Featured image upload
- Article search
- Publication scheduling

### 6. Messaging & Notifications

- Internal messaging system
- Notification system
- Unread message/notification counts

## Common Tasks

### Adding a New Batch

1. Log in as Admin
2. Go to Admin Dashboard
3. Create batch record in database directly or add via seeder

### Creating a Job Posting

1. Log in as Admin
2. Navigate to Admin → Job Postings
3. Click "Create New Job"
4. Fill in job details
5. Set deadline date
6. Publish

### Managing Alumni Accounts

1. Log in as Admin
2. Navigate to Admin → Alumni Management
3. Search or filter alumni
4. Verify, activate, or deactivate accounts

### Posting News & Announcements

1. Log in as Admin
2. Navigate to Admin → News
3. Click "Create New Article"
4. Write content and upload featured image
5. Publish

## Troubleshooting

### Database Connection Error
```
Solution: Verify database credentials in .env file and ensure MariaDB is running
```

### Permission Denied Errors
```bash
# Fix file permissions
chmod -R 755 storage bootstrap/cache
chmod -R 755 public/storage
```

### Missing Application Key
```bash
php artisan key:generate
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Storage Link Issues
```bash
# Remove and recreate storage link
rm public/storage
php artisan storage:link
```

## Maintenance

### Regular Backups
```bash
# Backup database
mysqldump -u root -p mpsu_alumni > backup.sql

# Backup files
tar -czf alumni-system-backup.tar.gz .
```

### Update Dependencies
```bash
# Update Composer dependencies
composer update

# Update npm packages
npm update
```

### Log Files
- Application logs: `storage/logs/laravel.log`
- Nginx/Apache logs: Check your web server configuration

## Performance Optimization

### Database Optimization
```bash
# Add indexes
php artisan tinker
>>> DB::statement('ALTER TABLE alumni_profiles ADD INDEX idx_batch (batch_id)');
>>> DB::statement('ALTER TABLE job_applications ADD INDEX idx_alumni (alumni_id)');
>>> DB::statement('ALTER TABLE event_registrations ADD INDEX idx_alumni (alumni_id)');
```

### Cache Configuration
Edit `.env`:
```env
CACHE_DRIVER=file
SESSION_DRIVER=file
```

### Asset Optimization
```bash
# Production build with minification
npm run production
```

## Security Best Practices

1. **Change Default Credentials**: Immediately after installation
2. **Use HTTPS**: In production, enable SSL/TLS
3. **Regular Updates**: Keep Laravel and packages updated
4. **Database Security**: Use strong passwords
5. **File Permissions**: Set appropriate permissions on sensitive directories
6. **Backup Strategy**: Regular automated backups
7. **Environment Variables**: Never commit .env file to version control
8. **Rate Limiting**: Implement for API endpoints in production

## Deployment

### Production Checklist
- [ ] Set `APP_ENV=production` in .env
- [ ] Set `APP_DEBUG=false` in .env
- [ ] Generate new `APP_KEY`
- [ ] Configure SSL certificate
- [ ] Set up automated backups
- [ ] Configure log rotation
- [ ] Set up monitoring
- [ ] Enable caching
- [ ] Optimize database

### Deploy to Server
```bash
git clone <repository-url> /var/www/alumni
cd /var/www/alumni
composer install --no-dev
php artisan config:cache
php artisan route:cache
npm install
npm run production
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data .
```

## Support & Contact

For issues, questions, or feature requests:
- **Email**: alumni@mpsu.edu
- **IT Department**: MPSU IT Support
- **Phone**: +63 74 722-2000

## License

Proprietary - Mountain Province State University. All rights reserved.

---

**Last Updated**: January 12, 2024
**Version**: 1.0.0

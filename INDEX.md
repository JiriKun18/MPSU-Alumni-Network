# MPSU Alumni Management System - Documentation Index

Welcome to the MPSU Alumni Management System! This is a comprehensive Laravel-based application for managing alumni records, jobs, events, and announcements.

## 📚 Documentation Files

### Quick References
- **[QUICKSTART.md](QUICKSTART.md)** - Get started in 5 minutes
- **[README.md](README.md)** - Project overview and general information
- **[INSTALLATION.md](INSTALLATION.md)** - Detailed installation and setup guide
- **[FEATURES.md](FEATURES.md)** - Complete feature list and architecture

## 🚀 Getting Started

### First Time Users
1. Read [QUICKSTART.md](QUICKSTART.md)
2. Run `install.bat` (Windows) or `bash install.sh` (Linux/Mac)
3. Access http://localhost:8000

### Detailed Setup
For comprehensive installation instructions, see [INSTALLATION.md](INSTALLATION.md)

## 👥 User Roles

### Administrator
- **Email**: admin@mpsu.edu
- **Password**: admin@123456
- **Access**: Full system management
- **Features**: Alumni management, job postings, events, news

### Alumni
- **Email**: alumni1@mpsu.edu or alumni2@mpsu.edu
- **Password**: alumni@123456
- **Access**: Profile and community features
- **Features**: Profile management, job browsing, event registration

## 📂 File Structure

```
mpsu-alumni/
├── 📄 QUICKSTART.md          ← Start here! (5-min setup)
├── 📄 README.md              ← Project overview
├── 📄 INSTALLATION.md        ← Detailed installation
├── 📄 FEATURES.md            ← Complete feature list
├── 📄 .env.example           ← Database config template
├── 📄 install.bat            ← Windows installation script
├── 📄 install.sh             ← Linux/Mac installation script
├── 📂 app/
│   ├── Models/              ← Database models
│   └── Http/Controllers/    ← Application logic
├── 📂 database/
│   ├── migrations/          ← Database table definitions
│   └── seeders/             ← Sample data (10 test alumni)
├── 📂 resources/views/      ← User interface
├── 📂 routes/               ← URL routing
└── 📂 public/               ← Web-accessible files
```

## 🛠️ Technology Stack

| Component | Technology |
|-----------|-----------|
| **Framework** | Laravel 9.x |
| **Language** | PHP 8.0+ |
| **Database** | MariaDB/MySQL 5.7+ |
| **Frontend** | Bootstrap 5, Blade Templates |
| **Build Tool** | Node.js, npm |
| **Authentication** | Laravel Sanctum, Sessions |

## 💾 Database Information

**Database Name**: mpsu_alumni
**Default Connection**: MySQL/MariaDB

### Main Tables
1. users - User accounts
2. alumni_profiles - Alumni details
3. batches - Graduation years
4. job_postings - Job listings
5. job_applications - Job applications
6. events - University events
7. event_registrations - Event attendance
8. news - News articles
9. messages - Internal messages
10. notifications - System notifications

See [INSTALLATION.md](INSTALLATION.md#database-schema) for detailed table definitions.

## 🎯 Key Features

### Alumni Can:
✅ Create and manage profiles  
✅ Browse alumni directory  
✅ Apply for job postings  
✅ Register for events  
✅ Read news and announcements  
✅ Send messages  
✅ Receive notifications  

### Administrators Can:
✅ Manage all alumni accounts  
✅ Create and manage job postings  
✅ Organize events  
✅ Post news and announcements  
✅ Review job applications  
✅ View system analytics  
✅ Verify alumni accounts  

See [FEATURES.md](FEATURES.md) for complete feature list.

## 🔐 Default Credentials

⚠️ **Change these immediately after login!**

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@mpsu.edu | admin@123456 |
| Alumni | alumni1@mpsu.edu | alumni@123456 |

## ⚡ Quick Start Commands

```bash
# Windows
install.bat

# Linux/Mac
bash install.sh

# Or manual installation
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

Then visit: **http://localhost:8000**

## 🌐 Important URLs

### Public Pages
- Home: `http://localhost:8000`
- Jobs: `http://localhost:8000/jobs`
- Events: `http://localhost:8000/events`
- News: `http://localhost:8000/news`

### Alumni Dashboard
- Dashboard: `http://localhost:8000/alumni/dashboard`
- Profile: `http://localhost:8000/alumni/profile`
- Directory: `http://localhost:8000/alumni/directory`

### Admin Panel
- Dashboard: `http://localhost:8000/admin/dashboard`
- Alumni: `http://localhost:8000/admin/alumni`
- Jobs: `http://localhost:8000/admin/jobs`
- Events: `http://localhost:8000/admin/events`
- News: `http://localhost:8000/admin/news`

## 📖 Common Tasks

### Creating a Job Posting
1. Login as admin
2. Go to Admin → Job Postings
3. Click "Create New Job"
4. Fill in details and submit

### Managing Alumni
1. Login as admin
2. Go to Admin → Alumni Management
3. Search, filter, or verify accounts

### Posting News
1. Login as admin
2. Go to Admin → News
3. Create article with featured image
4. Publish

See [FEATURES.md](FEATURES.md) for more use cases.

## ❓ Troubleshooting

### Database Connection Error
✗ **Problem**: Cannot connect to database
✓ **Solution**: Check `.env` file database credentials

### Permission Issues
✗ **Problem**: Permission denied errors
✓ **Solution**: Run `chmod -R 755 storage bootstrap/cache`

### Missing Application Key
✗ **Problem**: Application key missing
✓ **Solution**: Run `php artisan key:generate`

### CSS/JS Not Loading
✗ **Problem**: Styles and scripts missing
✓ **Solution**: Run `npm run dev` and `php artisan storage:link`

See [INSTALLATION.md](INSTALLATION.md#troubleshooting) for more solutions.

## 📞 Support Resources

- **Documentation**: See files in project root
- **Laravel Docs**: https://laravel.com/docs
- **Email**: alumni@mpsu.edu
- **IT Support**: MPSU IT Department

## 🔄 System Architecture

```
Browser (HTML/CSS/JS)
    ↓
Routes (web.php)
    ↓
Controllers (Business Logic)
    ↓
Models (Database Objects)
    ↓
Database (MariaDB)
```

## 🚀 Development Workflow

1. **Start Server**: `php artisan serve`
2. **Watch Assets**: `npm run watch`
3. **Make Changes**: Edit files in `app/`, `resources/`
4. **Test**: Refresh browser to see changes
5. **Commit**: `git commit -m "message"`

## 📋 Pre-Installation Checklist

- [ ] PHP 8.0+ installed
- [ ] Composer installed
- [ ] MariaDB/MySQL running
- [ ] Node.js installed
- [ ] npm installed
- [ ] Project folder accessible

## ✅ Post-Installation Checklist

- [ ] Database migrations completed
- [ ] Sample data seeded
- [ ] Storage link created
- [ ] Assets compiled
- [ ] Can login as admin
- [ ] Can login as alumni
- [ ] Changed default credentials

## 📊 Sample Data Included

The system comes with seeded data:
- 1 Admin account
- 10 Alumni accounts
- 6 Batches (2018-2024)
- Complete student profiles

See [INSTALLATION.md](INSTALLATION.md#database-schema) for more details.

## 🎓 Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [MySQL/MariaDB Guide](https://mariadb.com/kb/en/)
- [PHP 8 Features](https://www.php.net/manual/en/release/8.0/)

## 📝 File Descriptions

| File | Purpose |
|------|---------|
| `.env` | Database and app configuration |
| `.env.example` | Template for .env file |
| `composer.json` | PHP package dependencies |
| `package.json` | Node.js package dependencies |
| `routes/web.php` | Application URL routes |
| `database/migrations/` | Database table definitions |
| `app/Models/` | Eloquent database models |
| `app/Http/Controllers/` | Request handlers |
| `resources/views/` | HTML templates |

## 🎯 Next Steps

1. **Read [QUICKSTART.md](QUICKSTART.md)** for immediate setup
2. **Run installation script** (install.bat or install.sh)
3. **Login with demo credentials**
4. **Explore the features**
5. **Customize for your needs**
6. **Deploy to production**

## 🔐 Security Notes

✅ Use HTTPS in production  
✅ Change default credentials  
✅ Keep Laravel updated  
✅ Use strong database passwords  
✅ Regular backups  
✅ Monitor logs  
✅ Disable APP_DEBUG in production  

## 📈 Performance Tips

- Use database indexes (included)
- Enable query caching
- Minify assets in production
- Implement page caching
- Use CDN for static files
- Monitor database queries
- Set up automated backups

## 📢 Latest Updates

**Version**: 1.0.0  
**Last Updated**: January 12, 2024  
**Tested On**: PHP 8.0+, Laravel 9.x, MariaDB 10.5+

## 📄 License

Proprietary - Mountain Province State University  
All rights reserved.

---

## 🎉 Welcome!

You now have a complete alumni management system! Start with [QUICKSTART.md](QUICKSTART.md) and you'll be up and running in minutes.

**Questions?** Check the relevant documentation file or contact IT support.

**Happy coding! 🚀**

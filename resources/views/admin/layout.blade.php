<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - MPSU Alumni Network')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_mpsu.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-primary: #1a472a;
            --admin-secondary: #2d5016;
            --admin-accent: #4a7c2c;
            --admin-accent-light: #5a8c3c;
            --admin-gold: #d4af37;
            --admin-success: #059669;
            --admin-danger: #dc2626;
            --admin-warning: #f59e0b;
            --admin-info: #0891b2;
            --admin-bg: #f5f7f0;
            --admin-card: #ffffff;
            --admin-border: #e2e8f0;
            --admin-text: #1a472a;
            --admin-text-light: #64748b;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px rgba(0,0,0,0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
            font-size: 15px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Admin Navbar - Same style as user side */
        .admin-navbar {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%);
            box-shadow: 0 4px 20px rgba(45, 80, 22, 0.15);
            border-bottom: 3px solid var(--admin-gold);
            padding: 0.5rem 0;
        }

        .admin-navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.3s ease;
            color: white !important;
        }

        .admin-navbar .navbar-brand img {
            height: 35px;
            width: 35px;
            border-radius: 50%;
            background: white;
            padding: 2px;
        }

        .admin-navbar .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .admin-navbar .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 3px;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.35rem 0.65rem !important;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .admin-navbar .navbar-nav .nav-link i {
            font-size: 0.9rem;
            width: 15px;
            text-align: center;
        }

        .admin-navbar .navbar-nav .nav-link:hover {
            color: var(--admin-gold) !important;
            background: rgba(212, 175, 55, 0.15);
            transform: translateY(-2px);
        }

        .admin-navbar .navbar-nav .nav-link.active {
            color: var(--admin-gold) !important;
            background: rgba(212, 175, 55, 0.2);
            border-bottom: 3px solid var(--admin-gold);
            border-radius: 6px 6px 0 0;
        }

        .admin-navbar .dropdown-menu {
            background: white;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            margin-top: 0.5rem;
        }

        .admin-navbar .dropdown-item {
            padding: 0.75rem 1.25rem;
            transition: all 0.3s ease;
        }

        .admin-navbar .dropdown-itlalaem:hover {
            background: rgba(45, 80, 22, 0.1);
            color: var(--admin-primary);
        }
        

        .admin-nav-link:hover {
            color: var(--admin-accent);
            background: rgba(59, 130, 246, 0.05);
            border-bottom-color: var(--admin-accent-light);
        }

        .admin-nav-link.active {
            color: var(--admin-accent);
            background: rgba(59, 130, 246, 0.08);
            border-bottom-color: var(--admin-accent);
        /* Main content area */
        .admin-main-content {
            padding: 2rem 0;
            min-height: calc(100vh - 80px);
            margin-top: 1rem;
        }

        /* Page Header */
        .admin-page-header {
            background: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            border-left: 5px solid var(--admin-accent);
        }

        .admin-page-title {
            font-size: 2rem;
            font-weight: 900;
            color: var(--admin-text);
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .admin-page-subtitle {
            color: var(--admin-text-light);
            font-size: 1rem;
            font-weight: 500;
        }

        /* Cards styling */
        .card {
            border: 1px solid var(--admin-border);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
            border-color: var(--admin-accent-light);
        }

        .card-header {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(96, 165, 250, 0.05) 100%);
            border-bottom: 2px solid var(--admin-accent);
            font-weight: 700;
            color: var(--admin-text);
            padding: 1.25rem 1.5rem;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--admin-accent) 0%, var(--admin-accent-light) 100%);
            border: none;
            color: white;
            font-weight: 700;
            padding: 0.75rem 1.75rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(74, 124, 44, 0.3);
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-accent) 100%);
            box-shadow: 0 6px 16px rgba(74, 124, 44, 0.4);
            transform: translateY(-2px);
            color: white;
        }

        .btn-outline-primary {
            color: var(--admin-accent);
            border: 2px solid var(--admin-accent);
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            border-radius: 10px;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--admin-accent);
            border-color: var(--admin-accent);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 124, 44, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--admin-success) 0%, #059669 100%);
            border: none;
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--admin-warning) 0%, var(--admin-gold) 100%);
            border: none;
            color: var(--admin-text);
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, var(--admin-gold) 0%, var(--admin-warning) 100%);
            transform: translateY(-2px);
        }

        .quick-action-btn:hover {
            background: var(--admin-accent) !important;
            border-color: var(--admin-accent) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(74, 124, 44, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--admin-danger) 0%, #dc2626 100%);
            border: none;
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-2px);
        }

        /* Badges */
        .badge {
            font-size: 0.8rem;
            padding: 0.5rem 0.85rem;
            border-radius: 50px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Tables */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(96, 165, 250, 0.1) 100%);
            color: var(--admin-text);
            font-weight: 700;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(59, 130, 246, 0.05);
            transform: translateX(5px);
        }

        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1.25rem 1.5rem;
            box-shadow: var(--shadow-md);
            border-left: 4px solid;
        }

        .alert-success {
            background: #ecfdf5;
            border-left-color: var(--admin-success);
            color: #065f46;
        }

        .alert-warning {
            background: #fffbeb;
            border-left-color: var(--admin-warning);
            color: #92400e;
        }

        .alert-danger {
            background: #fef2f2;
            border-left-color: var(--admin-danger);
            color: #991b1b;
        }

        .alert-info {
            background: #f0f9ff;
            border-left-color: var(--admin-info);
            color: #075985;
        }

        /* Footer */
        .admin-footer {
            background: linear-gradient(135deg, var(--admin-primary) 0%, var(--admin-secondary) 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
            border-top: 3px solid var(--admin-gold);
        }

        .admin-footer p {
            margin: 0;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .admin-nav-links {
                flex-wrap: nowrap;
            }
            
            .admin-navbar-brand .brand-text {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .admin-page-title {
                font-size: 1.5rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Top email bar -->
    <div style="background: var(--admin-gold); color: var(--admin-primary); font-weight: 700;">
        <div class="container-fluid" style="display:flex; justify-content:flex-end; align-items:center; gap:8px; padding: 6px 0;">
            <i class="fas fa-envelope"></i> mpsu.alumni@gmail.com
        </div>
    </div>
    <!-- Premium Admin Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/logo_mpsu.png') }}" alt="MPSU Logo">
                MPSU Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.alumni-directory.*') ? 'active' : '' }}" href="{{ route('admin.alumni-directory.index') }}">
                            <i class="fas fa-user-graduate"></i> Alumni Directory
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}" href="#" id="jobsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-briefcase"></i> Jobs
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.jobs.index') }}"><i class="fas fa-list"></i> View All Jobs</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.jobs.create') ?? '#' }}"><i class="fas fa-plus-circle"></i> Post New Job</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="#" id="eventsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-calendar-alt"></i> Events
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.events.index') }}"><i class="fas fa-list"></i> View All Events</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.events.create') ?? '#' }}"><i class="fas fa-plus-circle"></i> Create New Event</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.news.*') ? 'active' : '' }}" href="#" id="newsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-newspaper"></i> News
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.news.index') }}"><i class="fas fa-list"></i> View All News</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.news.create') ?? '#' }}"><i class="fas fa-plus-circle"></i> Publish News</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.surveys.*') ? 'active' : '' }}" href="{{ route('admin.surveys.index') ?? '#' }}">
                            <i class="fas fa-poll"></i> Surveys
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.backups.*') ? 'active' : '' }}" href="{{ route('admin.backups.index') }}">
                            <i class="fas fa-database"></i> Backups
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="admin-main-content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Premium Footer -->
    <footer class="admin-footer text-center">
        <div class="container-fluid">
            <p class="mb-2">&copy; {{ date('Y') }} Mountain Province State University. All rights reserved.</p>
            <p class="mb-0"><small>MPSU Alumni Network - Admin Control Panel</small></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra-js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.APP_API_BASE = "{{ rtrim(url('/'), '/') }}";
    </script>
    <title>@yield('title', 'MPSU Alumni Network')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_mpsu.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo_mpsu.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0d4d2d;
            --secondary-color: #1a6b3d;
            --accent-gold: #d4af37;
            --accent-gold-light: #e6c758;
            --bg-light: #f5f7f0;
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            scroll-behavior: smooth;
            min-height: 100vh;
        }

        /* Top contact bar */
        .top-contact-bar {
            background: white;
            padding: 0.75rem 0;
            border-bottom: 2px solid var(--accent-gold);
        }

        .contact-info {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 2rem;
            font-size: 0.95rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .contact-info > div {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contact-info i {
            color: var(--accent-gold);
        }

        .btn-update-profile {
            background: var(--accent-gold);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-update-profile:hover {
            background: var(--accent-gold-light);
            transform: translateY(-2px);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 20px rgba(13, 77, 45, 0.15);
            border-bottom: 3px solid var(--accent-gold);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white !important;
            font-weight: 800;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 70px;
            width: 70px;
            border-radius: 10px;
            background: white;
            padding: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-brand-text .brand-main {
            font-size: 1rem;
            font-weight: 700;
        }

        .navbar-brand-text .brand-sub {
            font-size: 0.85rem;
            font-weight: 600;
            opacity: 0.95;
        }

        .navbar-nav .nav-link {
            color: var(--accent-gold) !important;
            font-weight: 600;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0 0.25rem;
            font-size: 0.95rem;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background: rgba(212, 175, 55, 0.2);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            color: white !important;
            background: rgba(212, 175, 55, 0.25);
        }

        .navbar-divider {
            border-left: 2px solid rgba(212, 175, 55, 0.4);
            height: 25px;
            margin: 0 0.5rem;
        }

        .main-content {
            min-height: calc(100vh - 200px);
            padding: 40px 0;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-gold) 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(45, 80, 22, 0.2);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .hero-section h1 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .card {
            border: none;
            border-top: 4px solid var(--accent-gold);
            box-shadow: 0 4px 15px rgba(45, 80, 22, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            background: white;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(45, 80, 22, 0.15);
            border-top-color: var(--accent-brown);
        }

        .card-header {
            background: linear-gradient(135deg, rgba(45, 80, 22, 0.05) 0%, rgba(74, 124, 44, 0.05) 100%);
            border-bottom: 2px solid var(--accent-gold);
            font-weight: 600;
            color: var(--primary-color);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(45, 80, 22, 0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1f380b 0%, #3a6623 100%);
            box-shadow: 0 6px 20px rgba(45, 80, 22, 0.35);
            transform: translateY(-2px);
            color: var(--accent-gold);
            border-color: var(--secondary-color);
        }

        /* Align outline and link buttons with brand colors */
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.25);
        }

        .btn-link,
        a.link-primary,
        .link-primary {
            color: var(--primary-color) !important;
        }

        .btn-link:hover,
        a.link-primary:hover,
        .link-primary:hover {
            color: #1f380b !important;
        }

        .footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
            border-top: 3px solid var(--accent-gold);
            text-align: center;
        }

        .footer h5 {
            font-weight: 700;
            color: var(--accent-gold);
            margin-bottom: 1rem;
        }

        .footer a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: white;
        }

        .footer-premium p {
            margin: 0;
            opacity: 0.9;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .sidebar {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(45, 80, 22, 0.08);
            border-left: 4px solid var(--accent-gold);
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav li {
            margin-bottom: 8px;
        }

        .sidebar-nav a {
            display: block;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: linear-gradient(135deg, rgba(45, 80, 22, 0.1) 0%, rgba(74, 124, 44, 0.1) 100%);
            color: var(--primary-color);
            border-left: 3px solid var(--accent-gold);
            padding-left: 12px;
        }

        .stat-card {
            text-align: center;
            padding: 30px;
            border-radius: 12px;
            background: white;
            border-top: 4px solid var(--accent-gold);
            box-shadow: 0 4px 15px rgba(45, 80, 22, 0.08);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(45, 80, 22, 0.15);
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .stat-card p {
            color: #666;
            margin: 0;
            font-weight: 500;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.6rem 0.9rem;
            border-radius: 8px;
            font-weight: 600;
        }

        .badge-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .badge-success {
            background: var(--success-color);
            color: white;
        }

        .badge-warning {
            background: var(--warning-color);
            color: white;
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Top Contact Bar -->
    <div class="top-contact-bar">
        <div class="container-fluid">
            <div class="contact-info">
                <div>
                    <i class="fas fa-envelope"></i>
                    mpsu.alumni@gmail.com
                </div>
                
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo_mpsu.png') }}" alt="MPSU Logo">
                <div class="navbar-brand-text">
                    <div class="brand-main">Mountain Province State University</div>
                    <div class="brand-sub">Alumni Network</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="background: rgba(212, 175, 55, 0.3); border: none;">
                <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 30 30%22%3E%3Cpath stroke=%22rgba(212, 175, 55, 1)%22 stroke-linecap=%22round%22 stroke-miterlimit=%2210%22 stroke-width=%222%22 d=%22M4 7h22M4 15h22M4 23h22%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: center;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto d-flex align-items-center">
                    @if (Auth::check())
                        <a href="{{ route('jobs.index') }}" class="nav-link"><i class="fas fa-briefcase"></i> Jobs</a>
                        <a href="{{ route('events.index') }}" class="nav-link"><i class="fas fa-calendar"></i> Events</a>
                        <a href="{{ route('news.index') }}" class="nav-link"><i class="fas fa-newspaper"></i> News</a>
                        @if (Auth::user()->role === 'alumni')
                            <a href="{{ route('alumni.directory') }}" class="nav-link"><i class="fas fa-users"></i> Alumni</a>
                            <a href="{{ route('surveys.index') }}" class="nav-link"><i class="fas fa-poll"></i> Surveys</a>
                        @endif
                        <div class="navbar-divider"></div>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" style="background: rgba(212, 175, 55, 0.25); border-radius: 6px; padding: 0.4rem 0.8rem !important;">
                                @php
                                    $navDisplayName = implode(' ', array_filter([
                                        Auth::user()->alumniProfile->family_name ?? '',
                                        Auth::user()->alumniProfile->given_name ?? '',
                                        Auth::user()->alumniProfile->middle_initial ?? '',
                                        Auth::user()->alumniProfile->suffix ?? '',
                                    ]));
                                @endphp
                                <i class="fas fa-user-circle"></i> {{ $navDisplayName ?: Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if (Auth::user()->role === 'alumni')
                                    <li><a class="dropdown-item" href="{{ route('alumni.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('alumni.profile') }}"><i class="fas fa-user"></i> My Profile</a></li>
                                @endif
                                @if (Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-crown"></i> Admin Dashboard</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="https://mpsu.edu.ph/?page_id=135" class="nav-link" target="_blank" rel="noopener noreferrer"><i class="fas fa-university"></i> About MPSU</a>
                        <a href="{{ route('home') }}#features" class="nav-link"><i class="fas fa-star"></i> Features</a>
                        <a href="{{ route('home') }}#how-it-works" class="nav-link"><i class="fas fa-info-circle"></i> How It Works</a>
                        <div class="navbar-divider"></div>
                        <a href="{{ route('login') }}" class="nav-link" style="background: rgba(212, 175, 55, 0.25); border-radius: 6px; padding: 0.4rem 0.8rem !important;">
                            <i class="fas fa-user"></i> Get in touch Alumni
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content">
        @if ($errors->any())
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row" style="text-align: left; padding: 2rem 0;">
                <div class="col-md-4 mb-4">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                        <img src="{{ asset('images/logo_mpsu.png') }}" alt="MPSU Logo" style="height: 40px; width: 40px; border-radius: 8px; background: white; padding: 4px;">
                        <h5 style="margin: 0; font-weight: 700; color: white;">MPSU Alumni Network</h5>
                    </div>
                    <p style="opacity: 0.9; font-size: 0.95rem;">
                        Connecting Mountain Province State University graduates worldwide since 1969.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 style="font-weight: 700; color: var(--accent-gold); margin-bottom: 1rem;">Quick Links</h5>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="https://mpsu.edu.ph/?page_id=135" style="color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i> About MPSU
                        </a>
                        <a href="{{ route('home') }}#features" style="color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">
                            <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i> Features
                        </a>
                        <a href="{{ route('login') }}" style="color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">
                            <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i> Get in touch Alumni
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 style="font-weight: 700; color: var(--accent-gold); margin-bottom: 1rem;">Contact Info</h5>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem; opacity: 0.9;">
                        <div>
                            <i class="fas fa-map-marker-alt" style="color: var(--accent-gold); width: 20px;"></i>
                            Bontoc, Mountain Province, Philippines
                        </div>
                        <div>
                            <i class="fas fa-envelope" style="color: var(--accent-gold); width: 20px;"></i>
                            mpsu.alumni@gmail.com
                        </div>
                        <div>
                            <i class="fas fa-globe" style="color: var(--accent-gold); width: 20px;"></i>
                            www.mpsu.edu.ph
                        </div>
                    </div>
                </div>
            </div>
            <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 1.5rem; text-align: center;">
                <p style="margin: 0; opacity: 0.9;">&copy; {{ date('Y') }} Mountain Province State University. All rights reserved.</p>
                <p style="font-size: 0.9rem; margin-top: 0.5rem; opacity: 0.8;">MPSU Alumni Network - Connecting Generations of Excellence</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra-js')
</body>
</html>

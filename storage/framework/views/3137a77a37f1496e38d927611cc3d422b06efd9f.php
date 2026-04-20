<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'MPSU Alumni Network'); ?></title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo_mpsu.png')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d4d2d;
            --primary-light: #1a6b3d;
            --secondary-color: #1a6b3d;
            --accent-gold: #d4af37;
            --accent-gold-light: #e6c758;
            --dark-bg: #f5f7f0;
            --card-bg: #ffffff;
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --border-color: #e2e8f0;
            --success-color: #059669;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.12);
            --shadow-xl: 0 20px 40px rgba(0,0,0,0.16);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f8fafc;
            color: var(--text-primary);
            font-size: 15px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(0.5px);
        }

        /* Premium Navigation Bar */
        .navbar-premium {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 20px rgba(13, 77, 45, 0.15);
            border-bottom: 3px solid var(--accent-gold);
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            font-family: 'Montserrat', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .navbar-premium .container-fluid {
            padding: 0 2rem;
        }

        .navbar-brand-premium {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white !important;
            font-weight: 800;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand-premium img {
            height: 70px;
            width: 70px;
            border-radius: 10px;
            background: white;
            padding: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar-brand-premium .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-brand-premium .brand-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.5px;
        }

        .navbar-brand-premium .brand-subtitle {
            font-size: 0.75rem;
            color: var(--accent-gold-light);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .navbar-brand-premium:hover {
            transform: translateX(5px);
        }

        /* Navigation Links */
        .navbar-nav-premium {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin: 0;
            padding: 0.5rem 0;
        }

        .nav-item-premium {
            position: relative;
        }

        .nav-link-premium {
            color: rgba(255, 255, 255, 0.92) !important;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.55rem 1.1rem !important;
            border-radius: 999px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0.2rem;
            letter-spacing: 0.5px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(6px);
        }

        .nav-link-premium::after {
            content: "";
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 6px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent-gold), transparent);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .nav-link-premium:hover {
            color: white !important;
            background: rgba(212, 175, 55, 0.18);
            border-color: rgba(212, 175, 55, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(13, 77, 45, 0.25);
        }

        .nav-link-premium:hover::after {
            transform: scaleX(1);
        }

        .nav-link-premium.active {
            color: #fff7d6 !important;
            background: rgba(212, 175, 55, 0.25);
            border-color: rgba(212, 175, 55, 0.65);
            box-shadow: 0 10px 20px rgba(13, 77, 45, 0.3);
        }

        .nav-link-premium.active::after {
            transform: scaleX(1);
        }

        .nav-link-premium i {
            font-size: 1rem;
            color: var(--accent-gold-light);
        }

        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 12px;
            padding: 0.35rem 0.6rem;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
        }

        /* Dropdown Menu */
        .dropdown-menu-premium {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
            padding: 0.75rem;
            margin-top: 0.5rem;
            min-width: 220px;
            animation: dropdownFadeIn 0.3s ease;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item-premium {
            color: var(--text-primary);
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
        }

        .dropdown-item-premium:hover {
            background: linear-gradient(135deg, rgba(26, 71, 42, 0.08) 0%, rgba(74, 124, 44, 0.08) 100%);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .dropdown-item-premium i {
            color: var(--accent-gold);
            width: 20px;
            text-align: center;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-top: 1px solid var(--border-color);
        }

        /* User Dropdown */
        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.55rem 1.1rem;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .user-dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(212, 175, 55, 0.6);
            box-shadow: 0 8px 18px rgba(13, 77, 45, 0.25);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, #f7e4a5, var(--accent-gold));
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
            border: 2px solid rgba(255, 255, 255, 0.6);
        }

        .user-name {
            color: rgba(255, 255, 255, 0.95);
            font-weight: 600;
            font-size: 0.9rem;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Main Content */
        .main-content-premium {
            min-height: calc(100vh - 180px);
            padding: 2.5rem 0;
        }

        /* Page Header */
        .page-header-premium {
            background: white;
            padding: 2.5rem 0;
            margin-bottom: 2.5rem;
            box-shadow: var(--shadow-sm);
            border-bottom: 2px solid var(--border-color);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            font-weight: 500;
        }

        /* Cards */
        .card-premium {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card-premium:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-gold);
        }

        .card-premium .card-header {
            background: linear-gradient(135deg, rgba(26, 71, 42, 0.05) 0%, rgba(74, 124, 44, 0.05) 100%);
            border-bottom: 2px solid var(--accent-gold);
            padding: 1.25rem 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .card-premium .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn-premium {
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-premium-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(26, 71, 42, 0.3);
        }

        .btn-premium-primary:hover {
            background: linear-gradient(135deg, #0f2618 0%, #3a6623 100%);
            box-shadow: 0 6px 20px rgba(26, 71, 42, 0.4);
            transform: translateY(-2px);
            color: white;
        }

        .btn-premium-gold {
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-gold-light) 100%);
            color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .btn-premium-gold:hover {
            background: linear-gradient(135deg, #c29d2e 0%, #d4af37 100%);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
            transform: translateY(-2px);
        }

        /* Ensure Bootstrap primary variants match brand (avoid default blue) */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            color: #fff;
            box-shadow: 0 4px 15px rgba(26, 71, 42, 0.3);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(135deg, #0f2618 0%, #3a6623 100%);
            color: #fff;
            box-shadow: 0 6px 20px rgba(26, 71, 42, 0.4);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 12px rgba(26, 71, 42, 0.3);
        }

        /* Footer */
        .footer-premium {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
            border-top: 3px solid var(--accent-gold);
            text-align: center;
        }

        .footer-premium p {
            margin: 0;
            opacity: 0.9;
        }

        .footer-premium h5 {
            font-weight: 700;
            color: var(--accent-gold);
            margin-bottom: 1rem;
        }

        .footer-premium a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-premium a:hover {
            color: white;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .navbar-nav-premium {
                padding: 1rem 0;
                gap: 0;
            }
            
            .nav-link-premium {
                margin: 0.25rem 0;
            }
            
            .user-dropdown-toggle {
                margin: 1rem 0;
            }
        }

        /* Secondary Navigation Bar for Alumni */
        .navbar-secondary {
            background: white;
            border-bottom: 2px solid var(--accent-gold);
            padding: 0.75rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .navbar-secondary a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-secondary a:hover,
        .navbar-secondary a.active {
            color: var(--accent-gold);
            background: rgba(212, 175, 55, 0.1);
        }

        /* Alumni Info Sections */
     

        /* Alert */
        .alert-premium {
            border: none;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            box-shadow: var(--shadow-md);
            border-left: 4px solid;
        }

        .alert-success {
            background: #ecfdf5;
            border-left-color: var(--success-color);
            color: #065f46;
        }

        .alert-warning {
            background: #fffbeb;
            border-left-color: #f59e0b;
            color: #92400e;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Top Contact Bar with Logo -->
    <div class="top-contact-bar" style="background: white; padding: 0.75rem 0; border-bottom: 2px solid var(--accent-gold);">
        <div class="container-fluid">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Logo Section -->
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="<?php echo e(asset('images/logo_mpsu.png')); ?>" alt="MPSU Logo" style="height: 60px; width: 60px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div>
                        <div style="font-size: 1.1rem; font-weight: 700; color: var(--primary-color); line-height: 1.2;">MPSU Alumni Network</div>
                        <div style="font-size: 0.75rem; color: var(--accent-gold); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Mountain Province State University</div>
                    </div>
                </div>
                <!-- Contact Info -->
                <div style="display: flex; align-items: center; gap: 2rem; font-size: 0.95rem; color: var(--primary-color); font-weight: 600;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-envelope" style="color: var(--accent-gold);"></i>
                        mpsu.alumni@gmail.com
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Secondary Navigation Bar (For Logged-in Alumni) -->
    <div class="navbar-secondary">
        <a href="https://mpsu.edu.ph/?page_id=135" class="scroll-to-section" target="_blank" rel="noopener noreferrer"><i class="fas fa-university"></i> About MPSU</a>
        <a href="<?php echo e(route('alumni.about')); ?>#features" class="scroll-to-section"><i class="fas fa-star"></i> Features</a>
        <a href="<?php echo e(route('alumni.about')); ?>#how-it-works" class="scroll-to-section"><i class="fas fa-info-circle"></i> How It Works</a>
    </div>
    
    <!-- Premium Navigation Bar -->
    <nav class="navbar navbar-premium navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-nav-premium">
                    <li class="nav-item nav-item-premium">
                        <a class="nav-link nav-link-premium <?php echo e(Request::is('alumni/dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('alumni.dashboard')); ?>">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-premium">
                        <a class="nav-link nav-link-premium <?php echo e(Request::is('jobs*') ? 'active' : ''); ?>" href="<?php echo e(route('jobs.index')); ?>">
                            <i class="fas fa-briefcase"></i>
                            <span>Jobs</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-premium">
                        <a class="nav-link nav-link-premium <?php echo e(Request::is('events*') ? 'active' : ''); ?>" href="<?php echo e(route('events.index')); ?>">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Events</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-premium">
                        <a class="nav-link nav-link-premium <?php echo e(Request::is('news*') ? 'active' : ''); ?>" href="<?php echo e(route('news.index')); ?>">
                            <i class="fas fa-newspaper"></i>
                            <span>News</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-premium">
                        <a class="nav-link nav-link-premium <?php echo e(Request::is('alumni/directory*') ? 'active' : ''); ?>" href="<?php echo e(route('alumni.alumni-dir')); ?>">
                            <i class="fas fa-users"></i>
                            <span>Alumni</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-premium">
                        <a class="nav-link nav-link-premium <?php echo e(Request::is('surveys*') ? 'active' : ''); ?>" href="<?php echo e(route('surveys.index')); ?>">
                            <i class="fas fa-poll"></i>
                            <span>Surveys</span>
                        </a>
                    </li>
                </ul>
                    
                <!-- User Dropdown on Right -->
                <ul class="navbar-nav navbar-nav-premium ms-auto">
                    <li class="nav-item nav-item-premium dropdown">
                        <?php if(auth()->guard()->check()): ?>
                        <?php
                            $displayFullName = implode(' ', array_filter([
                                Auth::user()->alumniProfile->family_name ?? '',
                                Auth::user()->alumniProfile->given_name ?? '',
                                Auth::user()->alumniProfile->middle_initial ?? '',
                                Auth::user()->alumniProfile->suffix ?? '',
                            ]));
                            $displayName = $displayFullName ?: Auth::user()->name;
                        ?>
                        <a class="nav-link nav-link-premium user-dropdown-toggle dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                <?php echo e(Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'G'); ?>

                            </div>
                            <span class="user-name d-none d-lg-inline"><?php echo e(Auth::user() ? Auth::user()->name : 'Guest'); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-premium dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item dropdown-item-premium" href="<?php echo e(route('alumni.profile')); ?>">
                                    <i class="fas fa-user"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item dropdown-item-premium">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                        <?php else: ?>
                        <a class="nav-link nav-link-premium" href="<?php echo e(route('login')); ?>" style="background: rgba(212, 175, 55, 0.25); border-radius: 6px; padding: 0.4rem 0.8rem !important;">
                            <i class="fas fa-user"></i> Get in touch Alumni
                        </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content-premium">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer-premium">
        <div class="container">
            <div class="row" style="text-align: left; padding: 2rem 0;">
                <div class="col-md-4 mb-4">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                        <img src="<?php echo e(asset('images/logo_mpsu.png')); ?>" alt="MPSU Logo" style="height: 40px; width: 40px; border-radius: 8px;">
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
                        <a href="<?php echo e(route('home')); ?>#features" style="color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">
                            <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i> Features
                        </a>
                        <a href="<?php echo e(route('login')); ?>" style="color: rgba(255,255,255,0.9); text-decoration: none; transition: color 0.3s;">
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
                <div style="margin-bottom: 1rem;">
                    <a href="<?php echo e(route('privacy-policy')); ?>" style="color: rgba(255,255,255,0.9); text-decoration: none; margin: 0 1rem; font-size: 0.9rem;">Privacy Policy</a>
                    <span style="color: rgba(255,255,255,0.5);">|</span>
                    <a href="<?php echo e(route('terms-of-service')); ?>" style="color: rgba(255,255,255,0.9); text-decoration: none; margin: 0 1rem; font-size: 0.9rem;">Terms of Service</a>
                </div>
                <p style="margin: 0; opacity: 0.9;">&copy; <?php echo e(date('Y')); ?> Mountain Province State University. All rights reserved.</p>
                <p style="font-size: 0.9rem; margin-top: 0.5rem; opacity: 0.8;">MPSU Alumni Network - Connecting Generations of Excellence</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll for secondary navbar links
        document.querySelectorAll('.scroll-to-section').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                        // Update active state
                        document.querySelectorAll('.scroll-to-section').forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                    }
                }
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\alumni system\resources\views/layouts/alumni.blade.php ENDPATH**/ ?>
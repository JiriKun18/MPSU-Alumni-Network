<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MPSU Alumni Network')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_mpsu.png') }}">
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

        /* Top Contact Bar */
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

        /* Minimal Premium Navigation */
        .navbar-premium-guest {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 20px rgba(13, 77, 45, 0.15);
            border-bottom: 3px solid var(--accent-gold);
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .navbar-premium-guest .container-fluid {
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand-guest {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white !important;
            font-weight: 800;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand-guest img {
            height: 70px;
            width: 70px;
            border-radius: 10px;
            background: white;
            padding: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar-brand-guest .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-brand-guest .brand-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.5px;
        }

        .navbar-brand-guest .brand-subtitle {
            font-size: 0.7rem;
            color: var(--accent-gold-light);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .navbar-brand-guest:hover {
            transform: translateX(5px);
        }

        .navbar-links-guest {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .navbar-links-guest a {
            color: var(--accent-gold) !important;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.95rem;
            text-decoration: none;
        }

        .navbar-links-guest a:hover {
            color: white !important;
            background: rgba(212, 175, 55, 0.2);
            transform: translateY(-2px);
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(0.5px);
        }

        .btn-premium {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.6rem 1.4rem;
            background: var(--accent-gold);
            color: var(--primary-color);
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-premium:hover {
            background: var(--accent-gold-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        @media (max-width: 768px) {
            .navbar-premium-guest .container-fluid {
                padding: 0 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-links-guest {
                flex-direction: column;
                gap: 0.5rem;
                width: 100%;
            }

            .navbar-links-guest a {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Top Contact Bar -->
    <div class="top-contact-bar">
        <div class="container-fluid">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Logo Section -->
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="{{ asset('images/logo_mpsu.png') }}" alt="MPSU Logo" style="height: 60px; width: 60px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
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

    <!-- Minimal Navigation Bar -->
    <nav class="navbar-premium-guest">
        <div class="container-fluid">
            <a href="{{ route('home') }}" class="navbar-brand-guest">
                <img src="{{ asset('images/logo_mpsu.png') }}" alt="MPSU Logo">
                <div class="brand-text">
                    <div class="brand-title">Mountain Province State University</div>
                    <div class="brand-subtitle">Alumni Network</div>
                </div>
            </a>

            <ul class="navbar-links-guest">
                <li><a href="https://mpsu.edu.ph/?page_id=135" target="_blank" rel="noopener noreferrer"><i class="fas fa-university"></i> About MPSU</a></li>
                <li><a href="{{ route('alumni.about') }}#features"><i class="fas fa-star"></i> Features</a></li>
                <li><a href="{{ route('alumni.about') }}#how-it-works"><i class="fas fa-info-circle"></i> How It Works</a></li>
                <li><a href="{{ route('admin.login') }}" class="btn-premium"><i class="fas fa-sign-in-alt"></i> Get in touch Alumni</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

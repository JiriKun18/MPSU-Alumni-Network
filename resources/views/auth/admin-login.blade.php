<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MPSU Alumni Network</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_mpsu.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a472a;
            --secondary-color: #2d5016;
            --accent-gold: #d4af37;
            --accent-gold-light: #e6c758;
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
            background: linear-gradient(135deg, #f5f7f0 0%, #e8ede0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-font-smoothing: antialiased;
        }

        .admin-login-container {
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .admin-login-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            border-top: 5px solid var(--accent-gold);
        }

        .admin-login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 3rem 2rem;
            text-align: center;
            color: white;
        }

        .admin-logo {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            background: white;
            padding: 8px;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-logo img {
            max-width: 100%;
            max-height: 100%;
        }

        .admin-login-title {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        .admin-login-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .admin-login-body {
            padding: 3rem 2.5rem;
        }

        .form-group-premium {
            margin-bottom: 1.5rem;
        }

        .form-label-premium {
            display: block;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .form-control-premium {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control-premium:focus {
            outline: none;
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-control-premium.is-invalid {
            border-color: #dc2626;
        }

        .invalid-feedback-premium {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }

        .btn-admin-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(26, 71, 42, 0.3);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-admin-login:hover {
            background: linear-gradient(135deg, #0f2618 0%, #1e3d0f 100%);
            box-shadow: 0 6px 20px rgba(26, 71, 42, 0.4);
            transform: translateY(-2px);
        }

        .admin-login-footer {
            padding: 2rem 2.5rem;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }

        .footer-text {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .footer-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--accent-gold);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            gap: 12px;
            color: var(--accent-gold);
        }

        .alert-premium {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
        }

        .alert-danger-premium {
            background: #fef2f2;
            border-left-color: #dc2626;
            color: #991b1b;
        }

        .alert-info-premium {
            background: #f0f9ff;
            border-left-color: #0891b2;
            color: #075985;
        }

        .alert-info-premium strong {
            color: var(--primary-color);
        }

        .admin-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-gold-light) 100%);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-top: 1rem;
        }

        @media (max-width: 480px) {
            .admin-login-body {
                padding: 2rem 1.5rem;
            }

            .admin-login-header {
                padding: 2rem 1.5rem;
            }

            .admin-login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-login-container">
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>

        <div class="admin-login-card">
            <div class="admin-login-header">
                <div class="admin-logo">
                    <img src="{{ asset('images/logo_mpsu.png') }}" alt="MPSU Logo">
                </div>
                <h1 class="admin-login-title">Admin Portal</h1>
                <p class="admin-login-subtitle">Secure Administrator Access</p>
            </div>

            <div class="admin-login-body">
                @if ($errors->any())
                    <div class="alert-premium alert-danger-premium">
                        <strong><i class="fas fa-exclamation-circle"></i> Login Failed</strong>
                        <ul class="mb-0 mt-2" style="padding-left: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login.store') }}" method="POST">
                    @csrf

                    <div class="form-group-premium">
                        <label for="email" class="form-label-premium">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control-premium @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" 
                            required 
                            placeholder="admin@mpsu.edu"
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback-premium">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group-premium">
                        <label for="password" class="form-label-premium">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div style="position: relative;">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control-premium @error('password') is-invalid @enderror" 
                                required 
                                placeholder="Enter your password"
                                style="padding-right: 45px;"
                            >
                            <button type="button" onclick="toggleAdminPassword()" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 5px; font-size: 1.1rem;">
                                <i class="fas fa-eye" id="toggleAdminIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback-premium">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-admin-login">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In as Administrator
                    </button>
                </form>

                <div class="alert-premium alert-info-premium mt-4">
                    <strong><i class="fas fa-shield-alt"></i> Authorized Access Only</strong>
                    <p class="mb-0 mt-2" style="font-size: 0.9rem;">This portal is restricted to administrators only. Unauthorized access attempts are logged.</p>
                </div>
            </div>

            <div class="admin-login-footer">
                <p class="footer-text">
                    Not an administrator? 
                    <a href="{{ route('home') }}" class="footer-link">Return to Home</a>
                </p>
                <span class="admin-badge">
                    <i class="fas fa-lock"></i> Secure Login
                </span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleAdminPassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleAdminIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
    </script>
</body>
</html>

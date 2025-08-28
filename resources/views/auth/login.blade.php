@extends('template.auth')
@section('title', 'Login')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.6s ease-out;
        }

        .login-header {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: white;
            text-align: center;
            padding: 3rem 2rem 2rem;
            position: relative;
        }

        .login-header::before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.95);
        }

        .logo-container {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .logo-container i {
            font-size: 2rem;
            color: #2563eb;
        }

        .login-body {
            padding: 3rem 2rem 2rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-floating .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(248, 250, 252, 0.8);
        }

        .form-floating .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background: white;
        }

        .form-floating label {
            color: #64748b;
            font-weight: 500;
        }

        .btn-login {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login.loading {
            color: transparent;
        }

        .btn-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-login.loading .btn-spinner {
            opacity: 1;
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 2rem 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 1rem;
            color: #64748b;
            font-size: 0.875rem;
        }

        .forgot-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #1d4ed8;
        }

        .demo-info {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1.5rem;
            border: 1px solid #e2e8f0;
        }

        .demo-info h6 {
            color: #475569;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .demo-info p {
            margin: 0;
            font-size: 0.875rem;
            color: #64748b;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            from {
                transform: translate(-50%, -50%) rotate(0deg);
            }
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            bottom: 10%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 1rem;
            }

            .login-header {
                padding: 2rem 1.5rem 1.5rem;
            }

            .login-body {
                padding: 2rem 1.5rem 1.5rem;
            }
        }
    </style>

    <div class="floating-shapes">
        <div class="shape">
            <i class="fas fa-hotel" style="font-size: 3rem; color: white;"></i>
        </div>
        <div class="shape">
            <i class="fas fa-bed" style="font-size: 2.5rem; color: white;"></i>
        </div>
        <div class="shape">
            <i class="fas fa-key" style="font-size: 2rem; color: white;"></i>
        </div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <i class="fas fa-hotel"></i>
                </div>
                <h4 class="mb-2 fw-bold">Laravel Hotel</h4>
                <p class="mb-0 opacity-75">Welcome back! Please sign in to continue.</p>
            </div>

            <div class="login-body">
                <form id="form-login" action="/login" method="POST">
                    @csrf

                    <div class="form-floating">
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email"
                            value="{{ old('email') }}" required autofocus>
                        <label for="email">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password" required>
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me for 30 days
                        </label>
                    </div>

                    <button id="btn_submit" class="btn btn-login text-white" type="submit">
                        <span id="text_submit">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Sign In to Dashboard
                        </span>
                        <div class="btn-spinner"></div>
                    </button>

                    <div class="divider">
                        <span>Need help?</span>
                    </div>

                    <div class="text-center">
                        <a href="/forgot-password" class="forgot-link">
                            <i class="fas fa-key me-1"></i>
                            Forgot your password?
                        </a>
                    </div>
                </form>

                <div class="demo-info">
                    <h6><i class="fas fa-info-circle me-2"></i>Demo Account</h6>
                    <p><strong>Email:</strong> wailantirajoh@gmail.com</p>
                    <p><strong>Password:</strong> wailan</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-login');
            const submitBtn = document.getElementById('btn_submit');
            const textSubmit = document.getElementById('text_submit');

            form.addEventListener('submit', function(e) {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                // Reset after 10 seconds if no response
                setTimeout(() => {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                }, 10000);
            });

            // Add floating animation to input focus
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection

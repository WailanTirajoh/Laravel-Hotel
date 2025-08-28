@extends('template.auth')

@section('content')
    <div class="auth-container">
        <!-- Animated Background -->
        <div class="auth-bg-animation">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
            </div>
        </div>

        <!-- Glassmorphism Card -->
        <div class="auth-card">
            <div class="auth-card-body">
                <!-- Logo Section -->
                <div class="auth-logo-section">
                    <div class="auth-logo">
                        <i class="fas fa-hotel text-primary"></i>
                    </div>
                    <h1 class="auth-title">Reset Password</h1>
                    <p class="auth-subtitle">Enter your email to receive reset link</p>
                </div>

                <!-- Status Message -->
                @if (session('status'))
                    <div class="alert alert-success auth-alert" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Reset Form -->
                <form method="POST" action="{{ route('password.email') }}" class="auth-form" id="resetForm">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <div class="input-wrapper">
                            <input
                                id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                                placeholder="Enter your email address"
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary auth-submit-btn" id="submitBtn">
                        <span class="btn-text">
                            <i class="fas fa-paper-plane me-2"></i>
                            Send Reset Link
                        </span>
                        <span class="btn-loading d-none">
                            <i class="fas fa-spinner fa-spin me-2"></i>
                            Sending...
                        </span>
                    </button>

                    <!-- Back to Login -->
                    <div class="auth-links">
                        <a href="{{ route('login') }}" class="auth-link">
                            <i class="fas fa-arrow-left me-2"></i>
                            Back to Login
                        </a>
                    </div>
                </form>

                <!-- Help Section -->
                <div class="auth-help">
                    <div class="help-item">
                        <i class="fas fa-info-circle text-info"></i>
                        <span>Enter the email address associated with your account</span>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-clock text-warning"></i>
                        <span>Reset link will expire in 60 minutes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .auth-alert {
            border: none;
            border-radius: 12px;
            background: rgba(25, 135, 84, 0.1);
            color: #198754;
            border-left: 4px solid #198754;
            margin-bottom: 1.5rem;
            animation: slideInDown 0.5s ease-out;
        }

        .auth-help {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .help-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .help-item i {
            font-size: 1rem;
            flex-shrink: 0;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');

            // Show loading state
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
            submitBtn.disabled = true;

            // Add loading animation to button
            submitBtn.classList.add('btn-loading-active');

            // Re-enable button after 10 seconds (fallback)
            setTimeout(() => {
                btnText.classList.remove('d-none');
                btnLoading.classList.add('d-none');
                submitBtn.disabled = false;
                submitBtn.classList.remove('btn-loading-active');
            }, 10000);
        });

        // Add smooth focus animations
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('input-focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('input-focused');
            });
        });
    </script>
@endsection

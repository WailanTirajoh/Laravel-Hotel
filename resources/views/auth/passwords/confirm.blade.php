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
                        <i class="fas fa-shield-alt text-warning"></i>
                    </div>
                    <h1 class="auth-title">Confirm Password</h1>
                    <p class="auth-subtitle">Please confirm your password before continuing</p>
                </div>

                <!-- Confirmation Form -->
                <form method="POST" action="{{ route('password.confirm') }}" class="auth-form" id="confirmForm">
                    @csrf

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Current Password
                        </label>
                        <div class="input-wrapper">
                            <input
                                id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your current password"
                                autofocus
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-toggle-icon"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="auth-actions">
                        <button type="submit" class="btn btn-primary auth-submit-btn" id="submitBtn">
                            <span class="btn-text">
                                <i class="fas fa-check me-2"></i>
                                Confirm Password
                            </span>
                            <span class="btn-loading d-none">
                                <i class="fas fa-spinner fa-spin me-2"></i>
                                Confirming...
                            </span>
                        </button>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="btn btn-outline-light auth-secondary-btn">
                                <i class="fas fa-key me-2"></i>
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <!-- Back to Dashboard -->
                    <div class="auth-links">
                        <a href="{{ url()->previous() }}" class="auth-link">
                            <i class="fas fa-arrow-left me-2"></i>
                            Go Back
                        </a>
                    </div>
                </form>

                <!-- Security Notice -->
                <div class="auth-help">
                    <div class="security-notice">
                        <div class="notice-header">
                            <i class="fas fa-shield-alt text-warning me-2"></i>
                            <span>Security Confirmation</span>
                        </div>
                        <p class="notice-text">
                            This action requires password confirmation for your security.
                            Your password will not be stored and is only used for verification.
                        </p>
                    </div>

                    <div class="help-items">
                        <div class="help-item">
                            <i class="fas fa-clock text-info"></i>
                            <span>Session will remain active for secure operations</span>
                        </div>
                        <div class="help-item">
                            <i class="fas fa-lock text-success"></i>
                            <span>Your data is protected by encryption</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .auth-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .auth-secondary-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .auth-secondary-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .security-notice {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .notice-header {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #ffc107;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        .notice-text {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            line-height: 1.5;
            font-size: 0.875rem;
        }

        .help-items {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .help-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .help-item i {
            font-size: 1rem;
            flex-shrink: 0;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        .input-wrapper {
            position: relative;
        }

        @media (max-width: 768px) {
            .auth-actions {
                gap: 0.75rem;
            }

            .security-notice {
                padding: 1rem;
            }

            .notice-text {
                font-size: 0.8rem;
            }

            .help-item {
                font-size: 0.8rem;
            }
        }
    </style>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId + '-toggle-icon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordField.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }

        // Form submission
        document.getElementById('confirmForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');

            // Show loading state
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
            submitBtn.disabled = true;
            submitBtn.classList.add('btn-loading-active');
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

        // Auto-focus password field when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            if (passwordField) {
                setTimeout(() => {
                    passwordField.focus();
                }, 100);
            }
        });
    </script>

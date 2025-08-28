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
                        <i class="fas fa-key text-primary"></i>
                    </div>
                    <h1 class="auth-title">Set New Password</h1>
                    <p class="auth-subtitle">Enter your new password below</p>
                </div>

                <!-- Reset Form -->
                <form method="POST" action="{{ route('password.update') }}" class="auth-form" id="resetPasswordForm">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

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
                                value="{{ $email ?? old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                                placeholder="Your email address"
                                readonly
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>New Password
                        </label>
                        <div class="input-wrapper">
                            <input
                                id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Enter new password"
                                minlength="8"
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
                        <!-- Password Strength Indicator -->
                        <div class="password-strength" id="password-strength">
                            <div class="strength-bar">
                                <div class="strength-fill" id="strength-fill"></div>
                            </div>
                            <div class="strength-text" id="strength-text">Password strength</div>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label for="password-confirm" class="form-label">
                            <i class="fas fa-shield-alt me-2"></i>Confirm Password
                        </label>
                        <div class="input-wrapper">
                            <input
                                id="password-confirm"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Confirm new password"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
                                <i class="fas fa-eye" id="password-confirm-toggle-icon"></i>
                            </button>
                        </div>
                        <!-- Password Match Indicator -->
                        <div class="password-match" id="password-match" style="display: none;">
                            <i class="fas fa-check-circle text-success me-1"></i>
                            <span>Passwords match</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary auth-submit-btn" id="submitBtn">
                        <span class="btn-text">
                            <i class="fas fa-key me-2"></i>
                            Reset Password
                        </span>
                        <span class="btn-loading d-none">
                            <i class="fas fa-spinner fa-spin me-2"></i>
                            Resetting...
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

                <!-- Password Requirements -->
                <div class="auth-help">
                    <h6 class="text-white mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Password Requirements
                    </h6>
                    <div class="requirement-list">
                        <div class="requirement-item" id="req-length">
                            <i class="fas fa-circle requirement-icon"></i>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement-item" id="req-uppercase">
                            <i class="fas fa-circle requirement-icon"></i>
                            <span>One uppercase letter</span>
                        </div>
                        <div class="requirement-item" id="req-lowercase">
                            <i class="fas fa-circle requirement-icon"></i>
                            <span>One lowercase letter</span>
                        </div>
                        <div class="requirement-item" id="req-number">
                            <i class="fas fa-circle requirement-icon"></i>
                            <span>One number</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-bar {
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
            width: 0%;
        }

        .strength-text {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .password-match {
            font-size: 0.875rem;
            color: #28a745;
            margin-top: 0.5rem;
        }

        .requirement-list {
            display: grid;
            gap: 0.5rem;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }

        .requirement-item.met {
            color: #28a745;
        }

        .requirement-icon {
            font-size: 0.5rem;
            transition: all 0.3s ease;
        }

        .requirement-item.met .requirement-icon {
            color: #28a745;
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

        .form-control[readonly] {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
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

        // Password strength checker
        function checkPasswordStrength(password) {
            let score = 0;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(password)
            };

            // Update requirement indicators
            Object.keys(requirements).forEach(req => {
                const element = document.getElementById(`req-${req}`);
                if (requirements[req]) {
                    element.classList.add('met');
                    score++;
                } else {
                    element.classList.remove('met');
                }
            });

            return { score, total: 4 };
        }

        // Update password strength indicator
        function updatePasswordStrength(password) {
            const { score, total } = checkPasswordStrength(password);
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');

            const percentage = (score / total) * 100;
            strengthFill.style.width = percentage + '%';

            if (score === 0) {
                strengthFill.style.background = 'transparent';
                strengthText.textContent = 'Password strength';
                strengthText.style.color = 'rgba(255, 255, 255, 0.7)';
            } else if (score < 2) {
                strengthFill.style.background = '#dc3545';
                strengthText.textContent = 'Weak password';
                strengthText.style.color = '#dc3545';
            } else if (score < 3) {
                strengthFill.style.background = '#ffc107';
                strengthText.textContent = 'Fair password';
                strengthText.style.color = '#ffc107';
            } else if (score < 4) {
                strengthFill.style.background = '#fd7e14';
                strengthText.textContent = 'Good password';
                strengthText.style.color = '#fd7e14';
            } else {
                strengthFill.style.background = '#28a745';
                strengthText.textContent = 'Strong password';
                strengthText.style.color = '#28a745';
            }
        }

        // Check if passwords match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password-confirm').value;
            const matchIndicator = document.getElementById('password-match');

            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchIndicator.style.display = 'block';
                    matchIndicator.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i><span>Passwords match</span>';
                } else {
                    matchIndicator.style.display = 'block';
                    matchIndicator.innerHTML = '<i class="fas fa-times-circle text-danger me-1"></i><span>Passwords do not match</span>';
                    matchIndicator.style.color = '#dc3545';
                }
            } else {
                matchIndicator.style.display = 'none';
            }
        }

        // Event listeners
        document.getElementById('password').addEventListener('input', function() {
            updatePasswordStrength(this.value);
            checkPasswordMatch();
        });

        document.getElementById('password-confirm').addEventListener('input', checkPasswordMatch);

        // Form submission
        document.getElementById('resetPasswordForm').addEventListener('submit', function() {
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
    </script>
@endsection

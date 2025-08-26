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
                        <i class="fas fa-envelope-circle-check text-info"></i>
                    </div>
                    <h1 class="auth-title">Verify Email Address</h1>
                    <p class="auth-subtitle">Check your inbox for verification link</p>
                </div>

                <!-- Success Message -->
                @if (session('resent'))
                    <div class="alert alert-success auth-alert" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        A fresh verification link has been sent to your email address.
                    </div>
                @endif

                <!-- Verification Info -->
                <div class="verification-info">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-mail-bulk text-primary"></i>
                        </div>
                        <div class="info-content">
                            <h6>Email Sent</h6>
                            <p>We've sent a verification link to your email address. Please check your inbox and click the link to verify your account.</p>
                        </div>
                    </div>

                    <div class="verification-steps">
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <strong>Check your email</strong>
                                <span>Look for our verification email</span>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <strong>Click the link</strong>
                                <span>Follow the verification link in the email</span>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <strong>Start using the system</strong>
                                <span>Access your hotel management dashboard</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="auth-actions">
                    <form method="POST" action="{{ route('verification.resend') }}" class="d-inline w-100" id="resendForm">
                        @csrf
                        <button type="submit" class="btn btn-primary auth-submit-btn" id="resendBtn">
                            <span class="btn-text">
                                <i class="fas fa-paper-plane me-2"></i>
                                Resend Verification Email
                            </span>
                            <span class="btn-loading d-none">
                                <i class="fas fa-spinner fa-spin me-2"></i>
                                Sending...
                            </span>
                        </button>
                    </form>

                    <a href="{{ route('logout') }}" class="btn btn-outline-light auth-secondary-btn"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Use Different Account
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

                <!-- Help Section -->
                <div class="auth-help">
                    <div class="help-header">
                        <i class="fas fa-question-circle me-2"></i>
                        <span>Need Help?</span>
                    </div>

                    <div class="help-items">
                        <div class="help-item">
                            <i class="fas fa-search text-warning"></i>
                            <span>Check your spam/junk folder if you don't see the email</span>
                        </div>
                        <div class="help-item">
                            <i class="fas fa-clock text-info"></i>
                            <span>Verification links expire after 60 minutes</span>
                        </div>
                        <div class="help-item">
                            <i class="fas fa-envelope text-success"></i>
                            <span>Make sure your email address is correct</span>
                        </div>
                    </div>

                    <div class="contact-support">
                        <p class="mb-2">Still having trouble?</p>
                        <a href="mailto:support@hotelmanagement.com" class="support-link">
                            <i class="fas fa-headset me-2"></i>
                            Contact Support
                        </a>
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

        .verification-info {
            margin-bottom: 2rem;
        }

        .info-card {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .info-icon {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            background: rgba(13, 110, 253, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .info-content h6 {
            color: white;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .info-content p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            line-height: 1.5;
        }

        .verification-steps {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .step-number {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .step-content {
            display: flex;
            flex-direction: column;
        }

        .step-content strong {
            color: white;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .step-content span {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.875rem;
        }

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

        .help-header {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: white;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .help-items {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .help-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.4;
        }

        .help-item i {
            font-size: 1rem;
            flex-shrink: 0;
            margin-top: 0.125rem;
        }

        .contact-support {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-support p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.75rem;
        }

        .support-link {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .support-link:hover {
            color: #0a58ca;
            text-decoration: underline;
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

        @media (max-width: 768px) {
            .verification-steps {
                gap: 0.75rem;
            }

            .step-number {
                width: 28px;
                height: 28px;
                font-size: 0.75rem;
            }

            .info-card {
                padding: 1rem;
            }

            .info-icon {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }
        }
    </style>

    <script>
        // Form submission
        document.getElementById('resendForm').addEventListener('submit', function() {
            const resendBtn = document.getElementById('resendBtn');
            const btnText = resendBtn.querySelector('.btn-text');
            const btnLoading = resendBtn.querySelector('.btn-loading');

            // Show loading state
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
            resendBtn.disabled = true;
            resendBtn.classList.add('btn-loading-active');

            // Re-enable button after 10 seconds (fallback)
            setTimeout(() => {
                btnText.classList.remove('d-none');
                btnLoading.classList.add('d-none');
                resendBtn.disabled = false;
                resendBtn.classList.remove('btn-loading-active');
            }, 10000);
        });

        // Auto-refresh page after successful resend (if redirected back)
        @if (session('resent'))
            // Add success animation
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.querySelector('.auth-alert');
                if (alert) {
                    setTimeout(() => {
                        alert.style.animation = 'slideInDown 0.5s ease-out';
                    }, 100);
                }
            });
        @endif
    </script>

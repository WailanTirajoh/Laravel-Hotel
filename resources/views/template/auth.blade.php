<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite('resources/sass/app.scss')

    <title>@yield('title', 'Hotel Management System')</title>

    <!-- Auth Specific Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow-x: hidden;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
        }

        .auth-bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .floating-shapes {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 120px;
            height: 120px;
            top: 70%;
            left: 80%;
            animation-delay: 4s;
        }

        .shape-3 {
            width: 60px;
            height: 60px;
            top: 40%;
            left: 70%;
            animation-delay: 8s;
        }

        .shape-4 {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 60%;
            animation-delay: 12s;
        }

        .shape-5 {
            width: 140px;
            height: 140px;
            top: 80%;
            left: 20%;
            animation-delay: 16s;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-30px) rotate(120deg);
            }
            66% {
                transform: translateY(-10px) rotate(240deg);
            }
            100% {
                transform: translateY(0px) rotate(360deg);
            }
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 0;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-card-body {
            padding: 3rem 2rem;
        }

        .auth-logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .auth-title {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            margin-bottom: 0;
            font-weight: 400;
        }

        .auth-form {
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .input-focused {
            transform: scale(1.02);
            transition: transform 0.3s ease;
        }

        .auth-submit-btn {
            width: 100%;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .auth-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.3);
        }

        .auth-submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-loading-active {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: translateY(-2px) scale(1); }
            50% { transform: translateY(-2px) scale(1.02); }
            100% { transform: translateY(-2px) scale(1); }
        }

        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
        }

        .auth-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-link:hover {
            color: white;
            text-decoration: underline;
        }

        .auth-help {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #dc3545;
            background: rgba(220, 53, 69, 0.1);
            padding: 0.5rem;
            border-radius: 6px;
        }

        .is-invalid {
            border-color: #dc3545;
            background: rgba(220, 53, 69, 0.1);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .auth-container {
                padding: 1rem 0.5rem;
            }

            .auth-card-body {
                padding: 2rem 1.5rem;
            }

            .auth-title {
                font-size: 1.75rem;
            }

            .auth-logo {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <main>
        @yield('content')
    </main>

    <!-- Vite Scripts -->
    @vite('resources/js/app.js')

    <!-- Additional Scripts -->
    @yield('scripts')
</body>

</html>

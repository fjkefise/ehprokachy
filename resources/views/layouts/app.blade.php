<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Эх, прокачу!</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Шрифты -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Базовые стили -->
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #4f46e5;
            --accent: #f97316;
            --background: #0f172a;
            --text: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.05);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text);
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.2) 0%, transparent 30%),
                radial-gradient(circle at 80% 80%, rgba(249, 115, 22, 0.2) 0%, transparent 30%),
                radial-gradient(circle at 50% 50%, rgba(79, 70, 229, 0.1) 0%, transparent 50%);
            animation: backgroundPulse 8s ease-in-out infinite;
            filter: blur(20px);
            opacity: 0.8;
            z-index: -1;
        }

        @keyframes backgroundPulse {
            0%, 100% { 
                transform: scale(1);
                opacity: 0.8;
            }
            50% { 
                transform: scale(1.2);
                opacity: 0.4;
            }
        }

        .navbar {
            background: rgba(15, 23, 42, 0.8) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            color: var(--text) !important;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-modern {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%) rotate(45deg);
            transition: transform 0.5s ease;
        }

        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            color: white;
        }

        .btn-modern:hover::before {
            transform: translateX(100%) rotate(45deg);
        }

        .card-modern {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: var(--text);
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
            color: var(--text);
        }

        .form-label {
            color: var(--text);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* Анимации для страниц */
        .page-enter {
            opacity: 0;
            transform: translateY(20px);
        }

        .page-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.5s ease;
        }
    </style>
    
    <!-- Дополнительные стили -->
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand animate__animated animate__fadeIn" href="/">Эх, прокачу!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Панель управления</a>
                        </li>
                        <li class="nav-item animate__animated animate__fadeIn" style="animation-delay: 0.3s;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Выйти</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                        <li class="nav-item animate__animated animate__fadeIn" style="animation-delay: 0.3s;">
                            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main style="padding-top: 76px;" class="page-enter page-enter-active">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- GSAP для продвинутых анимаций -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/gsap.min.js"></script>
    
    <script>
        // Анимация при скролле
        document.addEventListener('DOMContentLoaded', function() {
            // Плавное появление элементов при скролле
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.card-modern').forEach(el => observer.observe(el));

            // Анимация навбара при скролле
            let lastScroll = 0;
            window.addEventListener('scroll', () => {
                const navbar = document.querySelector('.navbar');
                const currentScroll = window.pageYOffset;

                if (currentScroll <= 0) {
                    navbar.style.padding = '1rem 0';
                    navbar.style.background = 'rgba(15, 23, 42, 0.8)';
                } else if (currentScroll > lastScroll) {
                    navbar.style.padding = '0.5rem 0';
                    navbar.style.background = 'rgba(15, 23, 42, 0.95)';
                }
                lastScroll = currentScroll;
            });

            // Анимация кнопок
            document.querySelectorAll('.btn-modern').forEach(button => {
                button.addEventListener('mousemove', (e) => {
                    const rect = button.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    button.style.setProperty('--x', `${x}px`);
                    button.style.setProperty('--y', `${y}px`);
                });
            });
        });
    </script>
    
    <!-- Дополнительные скрипты -->
    @stack('scripts')
</body>
</html> 
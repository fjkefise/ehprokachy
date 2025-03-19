@extends('layouts.app')

@section('title', 'Главная')

@push('styles')
<style>
:root {
    --gradient-start: #4a6cf7;
    --gradient-end: #a855f7;
}

body {
    background: var(--background);
    color: var(--text);
}

/* Фоновые элементы */
.background-shapes {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    pointer-events: none;
    overflow: hidden;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    opacity: 0.03;
    animation: float 20s infinite;
}

.shape-1 {
    width: 400px;
    height: 400px;
    top: -100px;
    right: -100px;
    animation-delay: -5s;
}

.shape-2 {
    width: 300px;
    height: 300px;
    bottom: 10%;
    left: -50px;
    animation-delay: -10s;
}

.shape-3 {
    width: 200px;
    height: 200px;
    top: 30%;
    right: 20%;
    animation-delay: -15s;
}

@keyframes float {
    0%, 100% {
        transform: translate(0, 0) rotate(0deg);
    }
    25% {
        transform: translate(50px, 50px) rotate(90deg);
    }
    50% {
        transform: translate(0, 100px) rotate(180deg);
    }
    75% {
        transform: translate(-50px, 50px) rotate(270deg);
    }
}

.hero-section {
    position: relative;
    min-height: 60vh;
    display: flex;
    align-items: center;
    padding: 4rem 0;
    background: url('/images/hero-bg.jpg') center/cover no-repeat;
    color: white;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(13, 16, 45, 0.95), rgba(13, 16, 45, 0.85));
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1.1;
    letter-spacing: -1px;
}

.hero-description {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
}

.btn-primary, .btn-secondary {
    display: inline-flex;
    align-items: center;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    color: white;
    box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.btn-primary:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    color: white;
}

.btn-primary:hover {
    box-shadow: 0 8px 25px rgba(74, 108, 247, 0.4);
}

.cars-section {
    padding: 8rem 0;
    background: linear-gradient(180deg, #0d102d 0%, #070816 100%);
    position: relative;
}

.features-section {
    padding: 8rem 0;
    background: linear-gradient(180deg, rgba(13, 16, 45, 0.95) 0%, #0d102d 100%);
    position: relative;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 3rem;
    position: relative;
    z-index: 2;
}

.feature-card {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 24px;
    padding: 3rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    transition: all 0.4s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.05);
}

.feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    margin-bottom: 2rem;
    font-size: 2rem;
}

.feature-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 1.25rem;
    letter-spacing: -0.5px;
}

.feature-description {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
}

.stats-section {
    padding: 6rem 0;
    position: relative;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    text-align: center;
}

.stat-item {
    padding: 1.5rem;
}

.stat-number {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    letter-spacing: -1px;
}

.stat-label {
    font-size: 1.25rem;
    font-weight: 500;
}

.why-us-section {
    padding: 6rem 0;
    background: linear-gradient(180deg, rgba(13, 16, 45, 0.98) 0%, #0d102d 100%);
    position: relative;
}

.why-us-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 3rem;
    align-items: center;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 24px;
    padding: 3rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
}

.why-us-content {
    padding-right: 2rem;
}

.why-us-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 2rem;
    letter-spacing: -1px;
    line-height: 1.2;
}

.why-us-description {
    font-size: 1.25rem;
    line-height: 1.7;
    margin-bottom: 3rem;
}

.benefits-list {
    display: grid;
    gap: 1.5rem;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem;
    border-radius: 16px;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.benefit-item:hover {
    transform: translateX(5px);
    background: rgba(255, 255, 255, 0.05);
}

.benefit-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    font-size: 1.5rem;
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    color: white;
}

.benefit-text {
    font-size: 1.2rem;
    font-weight: 600;
}

.why-us-image {
    position: relative;
    height: 400px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.why-us-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.section-title {
    text-align: center;
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 4rem;
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -1px;
    line-height: 1.1;
}

.cars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2.5rem;
    margin-bottom: 4rem;
}

.car-card {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.4s ease;
    border: 1px solid rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
}

.car-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

.car-image {
    height: 240px;
    overflow: hidden;
}

.car-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.car-card:hover .car-image img {
    transform: scale(1.05);
}

.car-details {
    padding: 2rem;
}

.car-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 1.25rem;
    color: white;
    letter-spacing: -0.5px;
}

.car-info {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.car-info span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.car-info i {
    color: var(--gradient-start);
}

.car-price {
    margin-bottom: 1.5rem;
}

.price-amount {
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
}

.price-period {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
}

.btn-book {
    display: block;
    text-align: center;
    padding: 0.75rem;
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-book:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
    color: white;
}

.empty-state {
    text-align: center;
    padding: 4rem 0;
    color: rgba(255, 255, 255, 0.7);
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.site-footer {
    background: rgba(13, 16, 45, 0.95);
    padding: 4rem 0 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.footer-content {
    display: flex;
    justify-content: center;
    margin-bottom: 3rem;
}

.footer-section {
    max-width: 800px;
    width: 100%;
    text-align: center;
}

.footer-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 2rem;
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.5px;
}

.contact-info {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 16px;
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.contact-links {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.contact-link {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 1rem;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.contact-link:hover {
    background: rgba(255, 255, 255, 0.05);
    color: white;
    transform: translateY(-2px);
}

.contact-type {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.5);
    margin-bottom: 0.25rem;
}

.contact-value {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.9);
    text-align: center;
}

.contact-hours {
    margin-top: 2rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.hours-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: white;
}

.hours-list {
    display: grid;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.7);
}

.hours-item {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    color: rgba(255, 255, 255, 0.5);
}

.testimonials-section {
    padding: 8rem 0;
    background: linear-gradient(180deg, #0d102d 0%, rgba(13, 16, 45, 0.98) 100%);
    position: relative;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 4rem;
}

.testimonial-card {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 20px;
    padding: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.05);
}

.testimonial-content {
    position: relative;
    margin-bottom: 2rem;
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    line-height: 1.7;
    flex: 1;
}

.testimonial-content::before {
    content: '"';
    position: absolute;
    top: -1rem;
    left: -1rem;
    font-size: 4rem;
    color: var(--gradient-start);
    opacity: 0.3;
    font-family: serif;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: auto;
}

.author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-info {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
}

.author-name {
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.author-car {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.rating {
    color: #ffd700;
    font-size: 1.2rem;
    margin-top: 0.5rem;
    display: flex;
    gap: 0.25rem;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 3.5rem;
    }
    
    .hero-description {
        font-size: 1.25rem;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .cars-grid {
        grid-template-columns: 1fr;
    }
    
    .feature-card {
        padding: 2rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
    
    .why-us-title {
        font-size: 2.5rem;
    }
    
    .contact-links {
        flex-direction: column;
        gap: 1rem;
    }
    
    .contact-link {
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<div class="background-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
</div>

<div class="hero-section">
        <div class="container">
        <div class="hero-content animate__animated animate__fadeIn">
            <h1 class="hero-title">Эх, прокачу!</h1>
            <p class="hero-description">
                Откройте для себя новый уровень комфорта с нашим премиальным автопарком. 
                Бронируйте автомобиль прямо сейчас и отправляйтесь в незабываемое путешествие!
            </p>
            <div class="hero-buttons">
                    @auth
                    <a href="{{ route('bookings.create') }}" class="btn-primary">
                        <i class="fas fa-car me-2"></i>
                        Забронировать
                    </a>
                    @else
                    <a href="{{ route('register') }}" class="btn-primary">
                        <i class="fas fa-user-plus me-2"></i>
                        Регистрация
                    </a>
                    <a href="{{ route('login') }}" class="btn-secondary">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Войти
                    </a>
                    @endauth
            </div>
        </div>
    </div>
    <div class="hero-overlay"></div>
</div>

<div class="cars-section">
    <div class="container">
        <h2 class="section-title animate__animated animate__fadeIn">Наш автопарк</h2>
        
        @if($cars->isEmpty())
            <div class="empty-state animate__animated animate__fadeIn">
                <i class="fas fa-car-alt"></i>
                <p>В данный момент нет доступных автомобилей</p>
            </div>
        @else
            <div class="cars-grid">
            @foreach($cars as $car)
                    <div class="car-card animate__animated animate__fadeIn" style="animation-delay: {{ $loop->iteration * 0.1 }}s">
                        <div class="car-image">
                            <img src="{{ asset('images/cars/' . $car->image) }}" alt="{{ $car->brand }} {{ $car->model }}">
                        </div>
                        <div class="car-details">
                            <h3 class="car-title">{{ $car->brand }} {{ $car->model }}</h3>
                            <div class="car-info">
                                <span><i class="fas fa-palette"></i> {{ $car->color }}</span>
                                <span><i class="fas fa-hashtag"></i> {{ $car->license_plate }}</span>
                            </div>
                            <div class="car-price">
                                <span class="price-amount">{{ number_format($car->price_per_day, 0, ',', ' ') }} ₽</span>
                                <span class="price-period">/ день</span>
                            </div>
                            @auth
                                <a href="{{ route('bookings.create', ['car' => $car->id]) }}" class="btn-book">
                                    Забронировать
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-book">
                                    Войти для бронирования
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="features-section">
    <div class="container">
        <h2 class="section-title animate__animated animate__fadeIn">Почему выбирают нас</h2>
        <div class="features-grid">
            <div class="feature-card animate__animated animate__fadeIn" style="animation-delay: 0.1s">
                <div class="feature-icon">
                    <i class="fas fa-car"></i>
                </div>
                <h3 class="feature-title">Премиальный автопарк</h3>
                <p class="feature-description">
                    Широкий выбор современных автомобилей премиум-класса для любых целей
                </p>
            </div>
            <div class="feature-card animate__animated animate__fadeIn" style="animation-delay: 0.2s">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Полное страхование</h3>
                <p class="feature-description">
                    Все автомобили застрахованы по КАСКО и ОСАГО для вашего спокойствия
                </p>
            </div>
            <div class="feature-card animate__animated animate__fadeIn" style="animation-delay: 0.3s">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="feature-title">Быстрое оформление</h3>
                <p class="feature-description">
                    Простая система бронирования и быстрое оформление документов
                </p>
            </div>
        </div>
    </div>
</div>

<div class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item animate__animated animate__fadeIn" style="animation-delay: 0.1s">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Довольных клиентов</div>
            </div>
            <div class="stat-item animate__animated animate__fadeIn" style="animation-delay: 0.2s">
                <div class="stat-number">50+</div>
                <div class="stat-label">Автомобилей в парке</div>
            </div>
            <div class="stat-item animate__animated animate__fadeIn" style="animation-delay: 0.3s">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Поддержка клиентов</div>
            </div>
            <div class="stat-item animate__animated animate__fadeIn" style="animation-delay: 0.4s">
                <div class="stat-number">98%</div>
                <div class="stat-label">Положительных отзывов</div>
            </div>
        </div>
    </div>
</div>

<div class="why-us-section">
    <div class="container">
        <div class="why-us-grid">
            <div class="why-us-content animate__animated animate__fadeIn">
                <h2 class="why-us-title">Ваш комфорт - наш приоритет</h2>
                <p class="why-us-description">
                    Мы предлагаем не просто аренду автомобиля, а полноценный сервис премиум-класса. Наша цель - сделать ваше путешествие максимально комфортным и безопасным.
                </p>
                <div class="benefits-list">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="benefit-text">Бесплатная доставка автомобиля</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div class="benefit-text">Техническая поддержка 24/7</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="benefit-text">Гибкая система скидок</div>
                    </div>
                </div>
            </div>
            <div class="why-us-image animate__animated animate__fadeIn">
                <img src="{{ asset('images/cars/mercedes-e.jpg') }}" alt="Mercedes-Benz E-Class">
            </div>
        </div>
    </div>
</div>

<div class="testimonials-section">
    <div class="container">
        <h2 class="section-title animate__animated animate__fadeIn">Отзывы наших клиентов</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card animate__animated animate__fadeIn" style="animation-delay: 0.1s">
                <div class="testimonial-content">
                    Отличный сервис! Арендовал Mercedes E-Class на выходные. Автомобиль был в идеальном состоянии, 
                    а процесс оформления занял всего несколько минут.
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="fas fa-user" style="font-size: 1.5rem; padding: 0.8rem; color: white;"></i>
                    </div>
                    <div class="author-info">
                        <div class="author-name">Александр М.</div>
                        <div class="author-car">Mercedes-Benz E-Class</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card animate__animated animate__fadeIn" style="animation-delay: 0.2s">
                <div class="testimonial-content">
                    Впечатлен уровнем сервиса! Бесплатная доставка автомобиля и круглосуточная поддержка - 
                    это именно то, что нужно для комфортной аренды.
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="fas fa-user" style="font-size: 1.5rem; padding: 0.8rem; color: white;"></i>
                    </div>
                    <div class="author-info">
                        <div class="author-name">Дмитрий К.</div>
                        <div class="author-car">BMW X5</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card animate__animated animate__fadeIn" style="animation-delay: 0.3s">
                <div class="testimonial-content">
                    Регулярно пользуюсь услугами компании. Всегда идеально чистые автомобили и 
                    приятные бонусы для постоянных клиентов. Рекомендую всем своим друзьям и знакомым.
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar" style="flex-shrink: 0;">
                        <i class="fas fa-user" style="font-size: 1.5rem; padding: 0.8rem; color: white;"></i>
                    </div>
                    <div class="author-info" style="flex: 1; min-width: 0;">
                        <div class="author-name" style="white-space: nowrap;">Екатерина В.</div>
                        <div class="author-car" style="white-space: nowrap;">Audi A6</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3 class="footer-title">Контакты</h3>
                <div class="contact-info">
                    <div class="contact-links">
                        <a href="https://t.me/Kamilyanovpidoras" class="contact-link" target="_blank">
                            <div class="contact-type">Telegram</div>
                            <div class="contact-value">@Kamilyanovpidoras</div>
                        </a>
                        <a href="tel:+79962566044" class="contact-link">
                            <div class="contact-type">Телефон</div>
                            <div class="contact-value">+7 996 256 60 44</div>
                        </a>
                        <a href="mailto:semenohotnieoa@gmail.com" class="contact-link">
                            <div class="contact-type">Email</div>
                            <div class="contact-value">semenohotnieoa@gmail.com</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Эх, прокачу! Все права защищены.</p>
        </div>
    </div>
</footer>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Улучшенный параллакс эффект для карточек
    document.querySelectorAll('.car-card').forEach(card => {
        let rafId = null;
        
        card.addEventListener('mousemove', function(e) {
            if (rafId) return;
            
            rafId = requestAnimationFrame(() => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = ((y - centerY) / centerY) * 20;
                const rotateY = ((x - centerX) / centerX) * 20;
                
                card.style.transform = `
                    perspective(1000px) 
                    rotateX(${-rotateX}deg) 
                    rotateY(${rotateY}deg) 
                    translateZ(30px)
                `;
                
                // Эффект параллакса для изображения
                const img = card.querySelector('.car-image');
                if (img) {
                    img.style.transform = `
                        translateZ(50px) 
                        translateX(${rotateY * 0.5}px) 
                        translateY(${rotateX * 0.5}px)
                    `;
                }
                
                rafId = null;
            });
        });

        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)';
            const img = card.querySelector('.car-image');
            if (img) {
                img.style.transform = 'translateZ(30px)';
            }
        });
    });
});
</script>
@endpush

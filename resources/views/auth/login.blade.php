@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-modern animate__animated animate__fadeInUp">
                <h2 class="text-center mb-4 gradient-text">Вход в систему</h2>
                
                <form method="POST" action="{{ route('login') }}" class="animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Запомнить меня</label>
                        </div>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn-modern">
                            Войти
                        </button>
                        <a href="{{ route('register') }}" class="btn-modern" style="text-align: center; text-decoration: none;">
                            Регистрация
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

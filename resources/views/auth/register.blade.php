@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-modern animate__animated animate__fadeInUp">
                <h2 class="text-center mb-4 gradient-text">Регистрация</h2>
                
                <form method="POST" action="{{ route('register') }}" class="animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                    @csrf

                    <div class="mb-4">
                        <label for="full_name" class="form-label">ФИО</label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                               id="full_name" name="full_name" value="{{ old('full_name') }}" required autofocus
                               placeholder="Иванов Иван Иванович">
                        <div class="form-text text-light opacity-75">Введите полное ФИО как в паспорте</div>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required
                               placeholder="example@mail.ru">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required
                               placeholder="Минимум 8 символов">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required
                               placeholder="Повторите пароль">
                    </div>

                    <div class="mb-4">
                        <label for="driver_license" class="form-label">Номер водительского удостоверения</label>
                        <input type="text" class="form-control @error('driver_license') is-invalid @enderror" 
                               id="driver_license" name="driver_license" value="{{ old('driver_license') }}" required
                               placeholder="99 AA 123456"
                               pattern="^\d{2}\s[A-ZА-Я]{2}\s\d{6}$">
                        <div class="form-text text-light opacity-75">Формат: 99 AA 123456</div>
                        @error('driver_license')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn-modern">
                            Зарегистрироваться
                        </button>
                        <a href="{{ route('login') }}" class="btn-modern" style="text-align: center; text-decoration: none;">
                            Уже есть аккаунт? Войти
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

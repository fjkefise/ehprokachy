@extends('layouts.app')

@section('title', 'Доступные автомобили')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card-modern animate__animated animate__fadeIn">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="gradient-text m-0">Доступные автомобили</h2>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('cars.create') }}" class="btn-modern">Добавить автомобиль</a>
                        @endif
                    @endauth
                </div>

                @if($cars->isEmpty())
                    <div class="alert alert-info animate__animated animate__fadeIn">
                        Нет доступных автомобилей
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($cars as $car)
                            <div class="col-md-4">
                                <div class="car-card animate__animated animate__fadeIn" style="animation-delay: {{ $loop->iteration * 0.1 }}s">
                                    <div class="car-image">
                                        <img src="{{ asset('images/cars/' . $car->image) }}" 
                                             alt="{{ $car->brand }} {{ $car->model }}"
                                             class="img-fluid">
                                        <div class="car-price">
                                            {{ number_format($car->price_per_day, 0, ',', ' ') }} ₽<span class="small">/день</span>
                                        </div>
                                    </div>
                                    <div class="car-info">
                                        <h3>{{ $car->brand }} {{ $car->model }}</h3>
                                        <div class="car-details">
                                            <div class="detail">
                                                <i class="fas fa-palette"></i>
                                                <span>{{ $car->color }}</span>
                                            </div>
                                            <div class="detail">
                                                <i class="fas fa-car"></i>
                                                <span>{{ $car->license_plate }}</span>
                                            </div>
                                        </div>
                                        @auth
                                            @if(!auth()->user()->is_admin)
                                                <a href="{{ route('bookings.create', ['car_id' => $car->id]) }}" 
                                                   class="btn-modern w-100">Забронировать</a>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn-modern btn-secondary w-100">
                                                Войдите для бронирования
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.car-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.car-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.car-image {
    position: relative;
    height: 200px;
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

.car-price {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #6e8efb, #4a6cf7);
    color: white;
    padding: 8px 15px;
    border-radius: 25px;
    font-weight: bold;
}

.car-price .small {
    font-size: 0.8em;
    opacity: 0.8;
}

.car-info {
    padding: 20px;
}

.car-info h3 {
    margin: 0 0 15px;
    font-size: 1.2rem;
    font-weight: 600;
}

.car-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 20px;
}

.detail {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6c757d;
}

.detail i {
    font-size: 1rem;
    width: 20px;
    color: #4a6cf7;
}
</style>
@endpush 
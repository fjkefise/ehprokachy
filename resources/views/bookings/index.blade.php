@extends('layouts.app')

@section('title', 'Бронирования')

@section('content')
<div class="container mt-4">
    <div class="booking-card animate__animated animate__fadeIn">
        <h2 class="gradient-text mb-4">{{ auth()->user()->is_admin ? 'Все бронирования' : 'Мои бронирования' }}</h2>

        @if(session('success'))
            <div class="alert alert-modern animate__animated animate__fadeIn">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(!auth()->user()->is_admin)
            <div class="mb-4">
                <a href="{{ route('bookings.create') }}" class="btn-modern">
                    <i class="fas fa-plus-circle me-2"></i>
                    Создать бронирование
                </a>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>ID</th>
                        @if(auth()->user()->is_admin)
                            <th>Пользователь</th>
                        @endif
                        <th>Автомобиль</th>
                        <th>Период аренды</th>
                        <th>Длительность</th>
                        <th>Стоимость</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $loop->iteration * 0.05 }}s">
                            <td>{{ $booking->id }}</td>
                            @if(auth()->user()->is_admin)
                                <td>{{ $booking->user->name }}</td>
                            @endif
                            <td>
                                <div class="car-info">
                                    <div class="car-preview">
                                        <img src="{{ asset('images/cars/' . $booking->car->image) }}" 
                                             alt="{{ $booking->car->brand }} {{ $booking->car->model }}">
                                    </div>
                                    <div>
                                        <div class="car-name">{{ $booking->car->brand }} {{ $booking->car->model }}</div>
                                        <div class="car-details">
                                            <span class="text-muted">
                                                <i class="fas fa-palette"></i> {{ $booking->car->color }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('d.m.Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('d.m.Y') }}</td>
                            <td>{{ $booking->duration }} {{ trans_choice('день|дня|дней', $booking->duration) }}</td>
                            <td>{{ number_format($booking->total_price, 0, ',', ' ') }} ₽</td>
                            <td>
                                <span class="status-badge status-{{ $booking->status }}">
                                    @switch($booking->status)
                                        @case('new')
                                            Новая
                                            @break
                                        @case('confirmed')
                                            Подтверждена
                                            @break
                                        @case('rejected')
                                            Отклонена
                                            @break
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <div class="actions-group">
                                    @if(auth()->user()->is_admin && $booking->status === 'new')
                                        <form action="{{ route('bookings.confirm', $booking) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action confirm" title="Подтвердить">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('bookings.reject', $booking) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action reject" title="Отклонить">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-calendar-times"></i>
                                    <p>Бронирования отсутствуют</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.booking-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.gradient-text {
    background: linear-gradient(135deg, var(--primary), #a855f7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 700;
}

.alert-modern {
    background: rgba(74, 108, 247, 0.1);
    border: none;
    border-radius: 12px;
    color: var(--text);
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.alert-modern i {
    color: var(--primary);
    font-size: 1.2rem;
}

.table-modern {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 0.5rem;
}

.table-modern th {
    background: rgba(255, 255, 255, 0.05);
    color: var(--text);
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    border-radius: 12px;
}

.table-modern td {
    background: rgba(255, 255, 255, 0.02);
    padding: 1rem;
    color: var(--text);
    vertical-align: middle;
}

.table-modern tr td:first-child {
    border-radius: 12px 0 0 12px;
}

.table-modern tr td:last-child {
    border-radius: 0 12px 12px 0;
}

.car-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.car-preview {
    width: 60px;
    height: 40px;
    border-radius: 8px;
    overflow: hidden;
}

.car-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.car-name {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.car-details {
    font-size: 0.9rem;
}

.car-details i {
    color: var(--primary);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.status-new {
    background: rgba(74, 108, 247, 0.1);
    color: var(--primary);
}

.status-confirmed {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-rejected {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.actions-group {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.05);
    color: var(--text);
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-action:hover {
    transform: translateY(-2px);
}

.btn-action.confirm:hover {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.btn-action.reject:hover {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: var(--text);
    opacity: 0.7;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--primary);
}

.empty-state p {
    margin: 0;
    font-size: 1.1rem;
}

.btn-modern {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: 500;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: none;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(74, 108, 247, 0.4);
    color: white;
}
</style>
@endpush 
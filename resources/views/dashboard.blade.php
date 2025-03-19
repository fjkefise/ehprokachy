@extends('layouts.app')

@section('title', 'Панель управления')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card-modern animate__animated animate__fadeInUp">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="gradient-text mb-0">{{ auth()->user()->is_admin ? 'Все заявки' : 'Мои заявки' }}</h2>
                    @if(!auth()->user()->is_admin)
                        <a href="{{ route('bookings.create') }}" class="btn-modern">
                            <span class="me-2">+</span> Создать заявку
                        </a>
                    @endif
                </div>

                @if($bookings->isEmpty())
                    <div class="text-center py-5 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                        <h3 class="text-muted mb-4">Заявок пока нет</h3>
                        @if(!auth()->user()->is_admin)
                            <a href="{{ route('bookings.create') }}" class="btn-modern">
                                Создать первую заявку
                            </a>
                        @endif
                    </div>
                @else
                    <div class="table-responsive animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-light">№</th>
                                    @if(auth()->user()->is_admin)
                                        <th class="text-light">Пользователь</th>
                                    @endif
                                    <th class="text-light">Автомобиль</th>
                                    <th class="text-light">Дата</th>
                                    <th class="text-light">Статус</th>
                                    @if(auth()->user()->is_admin)
                                        <th class="text-light">Действия</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr class="align-middle">
                                        <td class="text-light">{{ $booking->id }}</td>
                                        @if(auth()->user()->is_admin)
                                            <td class="text-light">{{ $booking->user->name }}</td>
                                        @endif
                                        <td class="text-light">{{ $booking->car->brand }} {{ $booking->car->model }}</td>
                                        <td class="text-light">{{ $booking->booking_date }}</td>
                                        <td>
                                            @switch($booking->status)
                                                @case('new')
                                                    <span class="badge rounded-pill" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                                        Новая
                                                    </span>
                                                    @break
                                                @case('confirmed')
                                                    <span class="badge rounded-pill" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                                                        Подтверждена
                                                    </span>
                                                    @break
                                                @case('rejected')
                                                    <span class="badge rounded-pill" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                                        Отклонена
                                                    </span>
                                                    @break
                                            @endswitch
                                        </td>
                                        @if(auth()->user()->is_admin)
                                            <td>
                                                @if($booking->status === 'new')
                                                    <div class="d-flex gap-2">
                                                        <form method="POST" action="{{ route('bookings.update', $booking) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="confirmed">
                                                            <button type="submit" class="btn-modern btn-sm" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                                                                Подтвердить
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="{{ route('bookings.update', $booking) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="btn-modern btn-sm" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                                                Отклонить
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table {
        margin-bottom: 0;
    }
    
    .table > :not(caption) > * > * {
        background: transparent;
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    .btn-modern.btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }

    .badge {
        padding: 0.5rem 1rem;
        font-weight: 500;
    }
</style>
@endpush
@endsection 
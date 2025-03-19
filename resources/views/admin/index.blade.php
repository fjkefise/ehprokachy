<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель администратора - Эх, прокачу!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Эх, прокачу!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Панель управления</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Выйти</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Панель администратора</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Всего заявок</h5>
                        <p class="card-text display-4">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Новые</h5>
                        <p class="card-text display-4">{{ $stats['new'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Подтвержденные</h5>
                        <p class="card-text display-4">{{ $stats['confirmed'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Отклоненные</h5>
                        <p class="card-text display-4">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Список заявок</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="filterBookings('all')">Все</button>
                        <button type="button" class="btn btn-outline-warning" onclick="filterBookings('new')">Новые</button>
                        <button type="button" class="btn btn-outline-success" onclick="filterBookings('confirmed')">Подтвержденные</button>
                        <button type="button" class="btn btn-outline-danger" onclick="filterBookings('rejected')">Отклоненные</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="bookingsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ФИО</th>
                                <th>Телефон</th>
                                <th>Email</th>
                                <th>Автомобиль</th>
                                <th>Дата бронирования</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr data-status="{{ $booking->status }}">
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->user->full_name }}</td>
                                    <td>{{ $booking->user->phone }}</td>
                                    <td>{{ $booking->user->email }}</td>
                                    <td>{{ $booking->car->brand }} {{ $booking->car->model }}</td>
                                    <td>{{ $booking->booking_date->format('d.m.Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'rejected' ? 'danger' : 'warning') }}">
                                            {{ $booking->status === 'new' ? 'Новая' : ($booking->status === 'confirmed' ? 'Подтверждена' : 'Отклонена') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($booking->status === 'new')
                                            <form action="{{ route('admin.bookings.status', $booking) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="bi bi-check-lg"></i> Подтвердить
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.bookings.status', $booking) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-x-lg"></i> Отклонить
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterBookings(status) {
            const rows = document.querySelectorAll('#bookingsTable tbody tr');
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html> 
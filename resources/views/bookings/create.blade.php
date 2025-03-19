@extends('layouts.app')

@section('title', 'Создание заявки')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
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

.date-field {
    position: relative;
    margin-bottom: 1rem;
}

.date-field label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(248, 250, 252, 0.8);
    margin-bottom: 0.5rem;
}

.date-field label i {
    color: var(--primary);
}

.custom-date {
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    color: var(--text);
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.custom-date:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(74, 108, 247, 0.2);
    background: rgba(74, 108, 247, 0.1);
}

.custom-date::-webkit-calendar-picker-indicator {
    filter: invert(1);
    opacity: 0.7;
    cursor: pointer;
}

.custom-date::-webkit-calendar-picker-indicator:hover {
    opacity: 1;
}

.buttons-group {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-modern {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
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

.btn-cancel {
    background: rgba(255, 255, 255, 0.1);
    color: var(--text);
    box-shadow: none;
}

.btn-cancel:hover {
    background: rgba(255, 255, 255, 0.15);
    color: var(--text);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.car-select {
    display: grid;
    gap: 1rem;
    margin-bottom: 1rem;
}

.car-option {
    position: relative;
}

.car-radio {
    display: none;
}

.car-label {
    display: flex;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.car-radio:checked + .car-label {
    border-color: #4a6cf7;
    background: rgba(74, 108, 247, 0.1);
}

.car-preview {
    width: 120px;
    height: 80px;
    margin-right: 1rem;
    border-radius: 10px;
    overflow: hidden;
}

.car-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.car-details {
    flex: 1;
}

.car-details h4 {
    margin: 0 0 0.5rem;
    font-size: 1.1rem;
}

.car-info {
    display: flex;
    gap: 1rem;
    color: #6c757d;
    font-size: 0.9rem;
}

.car-color i {
    color: #4a6cf7;
}

.flatpickr-input {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 2px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 12px !important;
    color: var(--text) !important;
    padding: 0.75rem 1rem !important;
    font-size: 1rem !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
}

.flatpickr-input:focus {
    border-color: var(--primary) !important;
    box-shadow: 0 0 0 2px rgba(74, 108, 247, 0.2) !important;
    background: rgba(74, 108, 247, 0.1) !important;
}

/* Стили для календаря */
.flatpickr-calendar {
    background: rgba(31, 41, 55, 0.95) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 15px !important;
    backdrop-filter: blur(10px) !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
}

.flatpickr-calendar.arrowTop:before,
.flatpickr-calendar.arrowTop:after {
    border-bottom-color: rgba(255, 255, 255, 0.1) !important;
}

.flatpickr-months {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
    border-radius: 15px 15px 0 0 !important;
    padding: 0.5rem 0 !important;
}

.flatpickr-months .flatpickr-month {
    color: white !important;
}

.flatpickr-current-month .flatpickr-monthDropdown-months {
    background: transparent !important;
    color: white !important;
    font-weight: 600 !important;
}

.flatpickr-current-month input.cur-year {
    color: white !important;
    font-weight: 600 !important;
}

.flatpickr-weekday {
    color: var(--primary) !important;
    font-weight: 600 !important;
}

.flatpickr-day {
    color: var(--text) !important;
    border-radius: 8px !important;
}

.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
    border: none !important;
    color: white !important;
}

.flatpickr-day.selected:hover,
.flatpickr-day.startRange:hover,
.flatpickr-day.endRange:hover {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
}

.flatpickr-day:hover {
    background: rgba(74, 108, 247, 0.2) !important;
}

.flatpickr-day.today {
    border: 2px solid var(--primary) !important;
}

.flatpickr-day.disabled {
    color: rgba(255, 255, 255, 0.3) !important;
}

.flatpickr-prev-month,
.flatpickr-next-month {
    color: white !important;
}

.flatpickr-prev-month:hover svg,
.flatpickr-next-month:hover svg {
    fill: var(--accent) !important;
}
</style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="booking-card animate__animated animate__fadeIn">
                <h2 class="text-center mb-4 gradient-text">Создание заявки на бронирование</h2>

                <form method="POST" action="{{ route('bookings.store') }}" id="bookingForm">
                            @csrf

                    <div class="mb-4">
                        <label class="form-label">Выберите автомобиль</label>
                        <div class="car-select">
                                    @foreach($cars as $car)
                                <div class="car-option" data-value="{{ $car->id }}" data-price="{{ $car->price_per_day }}">
                                    <input type="radio" name="car_id" value="{{ $car->id }}" 
                                           id="car_{{ $car->id }}" class="car-radio" 
                                           {{ old('car_id') == $car->id ? 'checked' : '' }}>
                                    <label for="car_{{ $car->id }}" class="car-label">
                                        <div class="car-preview">
                                            <img src="{{ asset('images/cars/' . $car->image) }}" 
                                                 alt="{{ $car->brand }} {{ $car->model }}">
                                        </div>
                                        <div class="car-details">
                                            <h4>{{ $car->brand }} {{ $car->model }}</h4>
                                            <div class="car-info">
                                                <span class="car-color">
                                                    <i class="fas fa-palette"></i> {{ $car->color }}
                                                </span>
                                                <span class="car-price">
                                                    {{ number_format($car->price_per_day, 0, ',', ' ') }} ₽/день
                                                </span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                    @endforeach
                        </div>
                                @error('car_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="dates-section mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="date-field">
                                    <label for="start_date" class="form-label">
                                        <i class="fas fa-calendar-alt"></i>
                                        Дата начала аренды
                                    </label>
                                    <input type="text" 
                                           class="form-control flatpickr @error('start_date') is-invalid @enderror" 
                                           id="start_date" 
                                           name="start_date" 
                                           value="{{ old('start_date') }}" 
                                           placeholder="Выберите дату"
                                           required>
                                    @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="date-field">
                                    <label for="end_date" class="form-label">
                                        <i class="fas fa-calendar-alt"></i>
                                        Дата окончания аренды
                                    </label>
                                    <input type="text" 
                                           class="form-control flatpickr @error('end_date') is-invalid @enderror" 
                                           id="end_date" 
                                           name="end_date" 
                                           value="{{ old('end_date') }}" 
                                           placeholder="Выберите дату"
                                           required>
                                    @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                            </div>

                    <div class="price-info mb-4 d-none">
                        <div class="price-card">
                            <div class="price-header">
                                <h5>Расчет стоимости</h5>
                            </div>
                            <div class="price-body">
                                <div class="price-row">
                                    <span>Стоимость за день</span>
                                    <span id="pricePerDay">0 ₽</span>
                                </div>
                                <div class="price-row">
                                    <span>Количество дней</span>
                                    <span id="daysCount">0</span>
                                </div>
                                <div class="price-row total">
                                    <span>Итого</span>
                                    <span id="totalPrice">0 ₽</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="buttons-group">
                        <button type="submit" class="btn-modern">Создать заявку</button>
                        <a href="{{ route('dashboard') }}" class="btn-modern btn-cancel">Отмена</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация Flatpickr для начальной даты
    const startDatePicker = flatpickr("#start_date", {
        locale: 'ru',
        dateFormat: "d.m.Y",
        minDate: "today",
        disableMobile: true,
        onChange: function(selectedDates, dateStr) {
            if (selectedDates[0]) {
                endDatePicker.set('minDate', selectedDates[0]);
                calculatePrice();
            }
        }
    });

    // Инициализация Flatpickr для конечной даты
    const endDatePicker = flatpickr("#end_date", {
        locale: 'ru',
        dateFormat: "d.m.Y",
        minDate: "today",
        disableMobile: true,
        onChange: function(selectedDates) {
            calculatePrice();
        }
    });

    const form = document.getElementById('bookingForm');
    const carOptions = document.querySelectorAll('.car-radio');
    const priceInfo = document.querySelector('.price-info');
    const pricePerDayEl = document.getElementById('pricePerDay');
    const daysCountEl = document.getElementById('daysCount');
    const totalPriceEl = document.getElementById('totalPrice');

    function calculatePrice() {
        const selectedCar = document.querySelector('.car-radio:checked');
        const startDate = startDatePicker.selectedDates[0];
        const endDate = endDatePicker.selectedDates[0];

        if (!selectedCar || !startDate || !endDate) {
            priceInfo.classList.add('d-none');
            return;
        }

        const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
        
        if (days <= 0) {
            priceInfo.classList.add('d-none');
            return;
        }

        const pricePerDay = parseFloat(selectedCar.closest('.car-option').dataset.price);
        const totalPrice = pricePerDay * days;

        pricePerDayEl.textContent = new Intl.NumberFormat('ru-RU').format(pricePerDay) + ' ₽';
        daysCountEl.textContent = days;
        totalPriceEl.textContent = new Intl.NumberFormat('ru-RU').format(totalPrice) + ' ₽';
        priceInfo.classList.remove('d-none');
    }

    carOptions.forEach(option => {
        option.addEventListener('change', calculatePrice);
    });

    // Инициализация при загрузке страницы
    if (document.querySelector('.car-radio:checked')) {
        calculatePrice();
    }
});
</script>
@endpush
@endsection 
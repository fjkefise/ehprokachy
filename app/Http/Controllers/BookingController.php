<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = auth()->user()->is_admin 
            ? Booking::with(['user', 'car'])->latest()->get()
            : Booking::where('user_id', auth()->id())->with('car')->latest()->get();
            
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::where('is_available', true)->get();
        return view('bookings.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'car_id.required' => 'Выберите автомобиль',
            'car_id.exists' => 'Выбранный автомобиль недоступен',
            'start_date.required' => 'Укажите дату начала аренды',
            'start_date.date' => 'Неверный формат даты начала аренды',
            'start_date.after_or_equal' => 'Дата начала аренды не может быть раньше сегодняшнего дня',
            'end_date.required' => 'Укажите дату окончания аренды',
            'end_date.date' => 'Неверный формат даты окончания аренды',
            'end_date.after_or_equal' => 'Дата окончания аренды должна быть позже или равна дате начала',
        ]);

        // Проверяем, не забронирован ли автомобиль на выбранные даты
        $existingBooking = Booking::where('car_id', $validated['car_id'])
            ->where(function($query) use ($validated) {
                $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhere(function($q) use ($validated) {
                        $q->where('start_date', '<=', $validated['start_date'])
                          ->where('end_date', '>=', $validated['end_date']);
                    });
            })
            ->whereIn('status', ['new', 'confirmed'])
            ->first();

        if ($existingBooking) {
            return back()
                ->withInput()
                ->withErrors(['start_date' => 'Автомобиль уже забронирован на выбранные даты']);
        }

        // Получаем информацию об автомобиле
        $car = Car::findOrFail($validated['car_id']);
        
        // Рассчитываем количество дней и общую стоимость
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $days = $startDate->diffInDays($endDate) + 1;
        $totalPrice = $car->price_per_day * $days;

        // Создаем бронирование
        $booking = new Booking();
        $booking->car_id = $validated['car_id'];
        $booking->user_id = auth()->id();
        $booking->start_date = $validated['start_date'];
        $booking->end_date = $validated['end_date'];
        $booking->total_price = $totalPrice;
        $booking->status = 'new';
        $booking->save();

        return redirect()->route('bookings.index')
            ->with('success', 'Бронирование успешно создано! Ожидайте подтверждения.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:new,confirmed,rejected'
        ]);

        // Проверка, что заявка имеет статус "new"
        if ($booking->status !== 'new') {
            return back()->withErrors(['status' => 'Можно изменять статус только для новых заявок']);
        }

        $booking->update($validated);

        // Если бронирование подтверждено, обновляем статус автомобиля
        if ($validated['status'] === 'confirmed') {
            $booking->car->update(['is_available' => false]);
        }

        return redirect()->route('bookings.index')
            ->with('success', 'Статус бронирования обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Проверяем права на удаление
        if (!auth()->user()->is_admin && $booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Если бронирование было подтверждено, возвращаем автомобиль в доступные
        if ($booking->status === 'confirmed') {
            $booking->car->update(['is_available' => true]);
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Заявка успешно удалена');
    }
}

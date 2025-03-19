<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $bookings = auth()->user()->is_admin
            ? Booking::with(['user', 'car'])->latest()->get()
            : auth()->user()->bookings()->with('car')->latest()->get();

        return view('dashboard', compact('bookings'));
    }
} 
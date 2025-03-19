<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'car'])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => $bookings->count(),
            'new' => $bookings->where('status', 'new')->count(),
            'confirmed' => $bookings->where('status', 'confirmed')->count(),
            'rejected' => $bookings->where('status', 'rejected')->count(),
        ];

        return view('admin.index', compact('bookings', 'stats'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        if ($booking->status !== 'new') {
            return back()->with('error', 'Можно изменять статус только новых заявок');
        }

        $request->validate([
            'status' => 'required|in:confirmed,rejected'
        ]);

        $booking->update(['status' => $request->status]);

        $statusText = $request->status === 'confirmed' ? 'подтверждена' : 'отклонена';
        return back()->with('success', "Заявка #{$booking->id} успешно {$statusText}");
    }
} 
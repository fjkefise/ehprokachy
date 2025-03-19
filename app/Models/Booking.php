<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_price',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_price' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function getDurationAttribute(): int
    {
        return Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date)) + 1;
    }

    public function getFormattedTotalPriceAttribute(): string
    {
        return number_format($this->total_price, 0, ',', ' ') . ' ₽';
    }

    public function getStatusBadgeAttribute(): string
    {
        $classes = [
            'new' => 'bg-primary',
            'confirmed' => 'bg-success',
            'rejected' => 'bg-danger'
        ];

        $labels = [
            'new' => 'Новая',
            'confirmed' => 'Подтверждена',
            'rejected' => 'Отклонена'
        ];

        return sprintf(
            '<span class="badge %s">%s</span>',
            $classes[$this->status],
            $labels[$this->status]
        );
    }
}

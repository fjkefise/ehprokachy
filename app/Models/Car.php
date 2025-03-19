<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'color',
        'license_plate',
        'price_per_day',
        'is_available',
        'image'
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

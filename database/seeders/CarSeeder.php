<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'brand' => 'BMW',
                'model' => 'X5',
                'color' => 'Черный',
                'license_plate' => 'А123БВ777',
                'price_per_day' => 15000,
                'image' => 'bmw-x5.jpg'
            ],
            [
                'brand' => 'Mercedes-Benz',
                'model' => 'E-Class',
                'color' => 'Серебристый',
                'license_plate' => 'В456ГД777',
                'price_per_day' => 12000,
                'image' => 'mercedes-e.jpg'
            ],
            [
                'brand' => 'Audi',
                'model' => 'A6',
                'color' => 'Белый',
                'license_plate' => 'Е789ЖЗ777',
                'price_per_day' => 11000,
                'image' => 'audi-a6.jpg'
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'color' => 'Черный',
                'license_plate' => 'К012ЛМ777',
                'price_per_day' => 8000,
                'image' => 'toyota-camry.jpg'
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Passat',
                'color' => 'Синий',
                'license_plate' => 'Н345ОП777',
                'price_per_day' => 7000,
                'image' => 'vw-passat.jpg'
            ]
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
} 
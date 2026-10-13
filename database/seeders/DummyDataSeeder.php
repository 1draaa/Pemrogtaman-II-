<?php

namespace Database\Seeders;

use App\Models\Motor;
use App\Models\Leasing;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        Leasing::firstOrCreate(
            ['id' => 1],
            ['name' => 'Adira Finance', 'interest_rate' => 8.5]
        );

        Leasing::firstOrCreate(
            ['id' => 2],
            ['name' => 'BFI Finance', 'interest_rate' => 9.0]
        );

        Motor::firstOrCreate(
            ['id' => 1],
            [
                'brand' => 'Honda',
                'model' => 'Beat Street CBS',
                'type' => 'Matic',
                'year' => 2023,
                'price' => 15500000,
                'mileage' => 3200,
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd2585cd64?q=80&w=2070&auto=format&fit=crop',
                'status' => 'available'
            ]
        );

        Motor::firstOrCreate(
            ['id' => 2],
            [
                'brand' => 'Yamaha',
                'model' => 'Mio M3 125',
                'type' => 'Matic',
                'year' => 2022,
                'price' => 14800000,
                'mileage' => 5100,
                'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=2070&auto=format&fit=crop',
                'status' => 'available'
            ]
        );
    }
}

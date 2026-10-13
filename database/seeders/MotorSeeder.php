<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Motor;
use Illuminate\Support\Str;

class MotorSeeder extends Seeder
{
    public function run(): void
    {
        $motors = [
            ['name' => 'Honda Beat Street CBS', 'brand' => 'Honda', 'type' => 'Matic', 'year' => 2023, 'price' => 15500000, 'odometer' => 3200, 'tax_status' => 'Hidup (09/2026)', 'grade' => 'A', 'tag' => 'Baru Masuk', 'description' => 'Kondisi mulus, service rutin AHASS.', 'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Yamaha Mio M3 125', 'brand' => 'Yamaha', 'type' => 'Matic', 'year' => 2022, 'price' => 14800000, 'odometer' => 5100, 'tax_status' => 'Hidup (06/2026)', 'grade' => 'A', 'tag' => 'Irit', 'description' => 'Mesin halus, irit bensin.', 'image' => 'https://images.unsplash.com/photo-1444491741275-3747c53c99b4?q=80&w=1974&auto=format&fit=crop'],
            ['name' => 'Honda Supra X 125 FI', 'brand' => 'Honda', 'type' => 'Cub', 'year' => 2022, 'price' => 16800000, 'odometer' => 6300, 'tax_status' => 'Hidup (05/2026)', 'grade' => 'A', 'tag' => 'Terlaris', 'description' => 'Kuat dan irit, cocok untuk usaha.', 'image' => 'https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?q=80&w=1974&auto=format&fit=crop'],
            ['name' => 'Suzuki Address 115', 'brand' => 'Suzuki', 'type' => 'Matic', 'year' => 2021, 'price' => 12500000, 'odometer' => 7800, 'tax_status' => 'Hidup (03/2026)', 'grade' => 'B', 'tag' => 'Value', 'description' => 'Kenyamanan maksimal.', 'image' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Yamaha NMAX 155 Standard', 'brand' => 'Yamaha', 'type' => 'Matic', 'year' => 2022, 'price' => 27500000, 'odometer' => 4500, 'tax_status' => 'Hidup (08/2026)', 'grade' => 'A', 'tag' => 'Paling Dicari', 'description' => 'Maxi scooter favorit.', 'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Honda Vario 125 CBS', 'brand' => 'Honda', 'type' => 'Matic', 'year' => 2023, 'price' => 18200000, 'odometer' => 2100, 'tax_status' => 'Hidup (11/2026)', 'grade' => 'A', 'tag' => '', 'description' => 'Praktis dan bertenaga.', 'image' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Yamaha Jupiter Z1 115', 'brand' => 'Yamaha', 'type' => 'Cub', 'year' => 2021, 'price' => 13900000, 'odometer' => 9200, 'tax_status' => 'Hidup (02/2026)', 'grade' => 'B', 'tag' => 'Ekonomis', 'description' => 'Performa stabil.', 'image' => 'https://images.unsplash.com/photo-1444491741275-3747c53c99b4?q=80&w=1974&auto=format&fit=crop'],
            ['name' => 'Suzuki Satria F150', 'brand' => 'Suzuki', 'type' => 'Sport', 'year' => 2020, 'price' => 22500000, 'odometer' => 11000, 'tax_status' => 'Hidup (07/2026)', 'grade' => 'B', 'tag' => 'Gaya', 'description' => 'Suara knalpot gahar.', 'image' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Honda CBR 150R', 'brand' => 'Honda', 'type' => 'Sport', 'year' => 2023, 'price' => 38500000, 'odometer' => 2800, 'tax_status' => 'Hidup (10/2026)', 'grade' => 'A', 'tag' => 'Premium', 'description' => 'Sport ringkas, handling mantap.', 'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Yamaha Lexi 125', 'brand' => 'Yamaha', 'type' => 'Matic', 'year' => 2022, 'price' => 16500000, 'odometer' => 5400, 'tax_status' => 'Hidup (04/2026)', 'grade' => 'A', 'tag' => '', 'description' => 'Design stylish.', 'image' => 'https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?q=80&w=1974&auto=format&fit=crop'],
            ['name' => 'Honda Revo Fit 110', 'brand' => 'Honda', 'type' => 'Cub', 'year' => 2019, 'price' => 9500000, 'odometer' => 15600, 'tax_status' => 'Hidup (12/2025)', 'grade' => 'B', 'tag' => 'Laris', 'description' => 'Cocok untuk keluarga.', 'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Yamaha V-ixion R 150', 'brand' => 'Yamaha', 'type' => 'Sport', 'year' => 2021, 'price' => 25500000, 'odometer' => 6800, 'tax_status' => 'Hidup (06/2026)', 'grade' => 'A', 'tag' => '', 'description' => 'Performa sporty.', 'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Suzuki Nex II 115', 'brand' => 'Suzuki', 'type' => 'Matic', 'year' => 2020, 'price' => 10800000, 'odometer' => 10200, 'tax_status' => 'Hidup (08/2025)', 'grade' => 'B', 'tag' => 'Hemat', 'description' => 'Irit dan tangguh.', 'image' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Kawasaki W175 SE', 'brand' => 'Kawasaki', 'type' => 'Cruiser', 'year' => 2023, 'price' => 32000000, 'odometer' => 2300, 'tax_status' => 'Hidup (11/2026)', 'grade' => 'A', 'tag' => 'Retro', 'description' => 'Design klasik modern.', 'image' => 'https://images.unsplash.com/photo-1444491741275-3747c53c99b4?q=80&w=1974&auto=format&fit=crop'],
            ['name' => 'Honda PCX 160 ABS', 'brand' => 'Honda', 'type' => 'Matic', 'year' => 2024, 'price' => 34500000, 'odometer' => 1200, 'tax_status' => 'Hidup (12/2026)', 'grade' => 'A', 'tag' => 'Premium Matic', 'description' => 'Fitur lengkap, nyaman berkendara.', 'image' => 'https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?q=80&w=1974&auto=format&fit=crop'],
            ['name' => 'Yamaha FreeGo 125', 'brand' => 'Yamaha', 'type' => 'Matic', 'year' => 2022, 'price' => 17200000, 'odometer' => 4800, 'tax_status' => 'Hidup (07/2026)', 'grade' => 'A', 'tag' => '', 'description' => 'Desain modern dan ringkas.', 'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Suzuki Smash 115', 'brand' => 'Suzuki', 'type' => 'Cub', 'year' => 2020, 'price' => 8900000, 'odometer' => 13500, 'tax_status' => 'Hidup (05/2025)', 'grade' => 'B', 'tag' => 'Harga Murah', 'description' => 'Cocok untuk pemula.', 'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Honda CB150R Streetfire', 'brand' => 'Honda', 'type' => 'Sport', 'year' => 2021, 'price' => 28500000, 'odometer' => 7200, 'tax_status' => 'Hidup (09/2026)', 'grade' => 'A', 'tag' => '', 'description' => 'Agresif dan bertenaga.', 'image' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2070&auto=format&fit=crop'],
            ['name' => 'Yamaha Soul GT 125', 'brand' => 'Yamaha', 'type' => 'Matic', 'year' => 2019, 'price' => 11800000, 'odometer' => 11800, 'tax_status' => 'Hidup (03/2025)', 'grade' => 'B', 'tag' => '', 'description' => 'Stylish dan mudah dikendarai.', 'image' => 'https://images.unsplash.com/photo-1444491741275-3747c53c99b4?q=80&w=1974&auto=format&fit=crop'],
            ['name' => 'Kawasaki Ninja R 150', 'brand' => 'Kawasaki', 'type' => 'Sport', 'year' => 2020, 'price' => 26000000, 'odometer' => 8500, 'tax_status' => 'Hidup (10/2025)', 'grade' => 'A', 'tag' => 'Sporty', 'description' => 'Design aerodinamis.', 'image' => 'https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?q=80&w=1974&auto=format&fit=crop'],
            ['name' => 'Honda Scoopy eSP 110', 'brand' => 'Honda', 'type' => 'Matic', 'year' => 2023, 'price' => 15900000, 'odometer' => 2900, 'tax_status' => 'Hidup (02/2027)', 'grade' => 'A', 'tag' => 'Cute', 'description' => 'Desain lucu dan modern.', 'image' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2070&auto=format&fit=crop'],
        ];

        foreach ($motors as $motor) {
            $motor['slug'] = Str::slug($motor['name']);
            Motor::create($motor);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agents = [
            [
                'nama_agen' => 'Agen Jakarta Pusat',
                'alamat_agen' => 'Jl. Kebon Sirih No. 10, Jakarta Pusat',
                'latitude' => -6.1751,
                'longitude' => 106.8272,
                'kota' => 'Jakarta',
                'tarif' => 10000,
            ],
            [
                'nama_agen' => 'Agen Jakarta Selatan',
                'alamat_agen' => 'Jl. Gatot Subroto No. 15, Jakarta Selatan',
                'latitude' => -6.2349,
                'longitude' => 106.8205,
                'kota' => 'Jakarta',
                'tarif' => 11000,
            ],
            [
                'nama_agen' => 'Agen Jakarta Barat',
                'alamat_agen' => 'Jl. Panjang No. 8, Jakarta Barat',
                'latitude' => -6.1683,
                'longitude' => 106.7588,
                'kota' => 'Jakarta',
                'tarif' => 10500,
            ],
            [
                'nama_agen' => 'Agen Jakarta Timur',
                'alamat_agen' => 'Jl. Raya Bekasi No. 22, Jakarta Timur',
                'latitude' => -6.2147,
                'longitude' => 106.9023,
                'kota' => 'Jakarta',
                'tarif' => 10800,
            ],
            [
                'nama_agen' => 'Agen Jakarta Utara',
                'alamat_agen' => 'Jl. Pluit Raya No. 15, Jakarta Utara',
                'latitude' => -6.1279,
                'longitude' => 106.7944,
                'kota' => 'Jakarta',
                'tarif' => 11200,
            ],
            [
                'nama_agen' => 'Agen Bandung Kota',
                'alamat_agen' => 'Jl. Asia Afrika No. 5, Bandung',
                'latitude' => -6.9211,
                'longitude' => 107.6075,
                'kota' => 'Bandung',
                'tarif' => 9500,
            ],
            [
                'nama_agen' => 'Agen Surabaya Pusat',
                'alamat_agen' => 'Jl. Basuki Rahmat No. 11, Surabaya',
                'latitude' => -7.2620,
                'longitude' => 112.7381,
                'kota' => 'Surabaya',
                'tarif' => 9800,
            ],
            [
                'nama_agen' => 'Agen Medan Kota',
                'alamat_agen' => 'Jl. Diponegoro No. 7, Medan',
                'latitude' => 3.5898,
                'longitude' => 98.6810,
                'kota' => 'Medan',
                'tarif' => 12000,
            ],
            [
                'nama_agen' => 'Agen Makassar Kota',
                'alamat_agen' => 'Jl. Nusantara No. 12, Makassar',
                'latitude' => -5.1351,
                'longitude' => 119.4087,
                'kota' => 'Makassar',
                'tarif' => 11500,
            ],
            [
                'nama_agen' => 'Agen Denpasar Kota',
                'alamat_agen' => 'Jl. Raya Kuta No. 18, Denpasar',
                'latitude' => -8.6714,
                'longitude' => 115.2308,
                'kota' => 'Denpasar',
                'tarif' => 12500,
            ],
        ];

        foreach ($agents as $agent) {
            Agent::create($agent);
        }
    }
}

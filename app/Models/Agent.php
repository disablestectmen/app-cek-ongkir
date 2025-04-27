<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_agen',
        'alamat_agen',
        'latitude',
        'longitude',
        'kota',
        'tarif'
    ];

    /**
     * Menghitung jarak antara agen dengan koordinat yang diberikan
     *
     * @param float $lat
     * @param float $lng
     * @return float
     */
    public function calculateDistance($lat, $lng)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer

        $dLat = deg2rad($lat - $this->latitude);
        $dLon = deg2rad($lng - $this->longitude);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($this->latitude)) * cos(deg2rad($lat)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c;

        return round($distance, 2);
    }
}

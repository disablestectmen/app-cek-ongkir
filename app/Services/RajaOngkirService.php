<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RajaOngkirService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://rajaongkir.komerce.id/api/v1';
        $this->apiKey = '610YpjD4e1100659ca5bad06QhO8nG4M';
    }

    /**
     * Mencari destinasi berdasarkan nama wilayah
     *
     * @param string $search
     * @param int $limit
     * @return array
     */
    public function searchDestination($search, $limit = 5)
    {
        $cacheKey = 'destination_' . md5($search . '_' . $limit);

        return Cache::remember($cacheKey, 60 * 24, function () use ($search, $limit) {
            $response = Http::withOptions([
                'verify' => false, // Menonaktifkan verifikasi SSL
            ])->withHeaders([
                'key' => $this->apiKey
            ])->get($this->baseUrl . '/destination/domestic-destination', [
                'search' => $search,
                'limit' => $limit,
                'offset' => 0,
            ]);

            return $response->json();
        });
    }

    /**
     * Menghitung ongkos kirim
     *
     * @param array $params
     * @return array
     */
    public function hitungOngkir($params)
    {
        // Parameter yang dibutuhkan:
        // - origin_id (ID asal pengiriman)
        // - destination_id (ID tujuan pengiriman)
        // - weight (Berat dalam gram)
        // - courier (Kode kurir, misalnya: jne, tiki, dll)

        $response = Http::withOptions([
            'verify' => false, // Menonaktifkan verifikasi SSL
        ])->withHeaders([
            'key' => $this->apiKey
        ])->post($this->baseUrl . '/shipping/calculate', $params);

        return $response->json();
    }

    /**
     * Mendapatkan daftar agen terdekat berdasarkan latitude dan longitude
     *
     * @param float $latitude
     * @param float $longitude
     * @return array
     */
    public function getNearestAgents($latitude, $longitude)
    {
        // Logika implementasi untuk mendapatkan agen terdekat berdasarkan koordinat
        // Karena ini adalah fitur khusus yang mungkin tidak ada di API
        // Kita bisa mencari agen dari database lokal yang sudah memiliki koordinat

        // Contoh implementasi:
        return [
            'agents' => [
                [
                    'id' => 1,
                    'nama_agen' => 'Agen Jakarta Pusat',
                    'alamat_agen' => 'Jl. Kebon Sirih No. 10',
                    'latitude' => -6.1751,
                    'longitude' => 106.8272,
                    'jarak' => $this->calculateDistance($latitude, $longitude, -6.1751, 106.8272) . ' km'
                ],
                [
                    'id' => 2,
                    'nama_agen' => 'Agen Jakarta Selatan',
                    'alamat_agen' => 'Jl. Gatot Subroto No. 15',
                    'latitude' => -6.2349,
                    'longitude' => 106.8205,
                    'jarak' => $this->calculateDistance($latitude, $longitude, -6.2349, 106.8205) . ' km'
                ],
            ]
        ];
    }

    /**
     * Menghitung jarak antara dua titik koordinat (dalam km)
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c;

        return round($distance, 2);
    }
}

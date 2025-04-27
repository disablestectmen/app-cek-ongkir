<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RegionService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('INDONESIA_REGION_API_URL', 'http://127.0.0.1:9000');
    }

    /**
     * Mendapatkan daftar provinsi
     *
     * @return array
     */
    public function getProvinces()
    {
        return Cache::remember('provinces', 60 * 24, function () {
            $response = Http::withOptions([
                'verify' => false,
            ])->get($this->baseUrl . '/provinces');
            return $response->json();
        });
    }

    /**
     * Mendapatkan daftar kabupaten berdasarkan id provinsi
     *
     * @param int $provinceId
     * @return array
     */
    public function getRegencies($provinceId)
    {
        return Cache::remember('regencies_' . $provinceId, 60 * 24, function () use ($provinceId) {
            $response = Http::withOptions([
                'verify' => false,
            ])->get($this->baseUrl . '/provinces/' . $provinceId . '/regencies');
            return $response->json();
        });
    }

    /**
     * Mendapatkan daftar kecamatan berdasarkan id provinsi dan id kabupaten
     *
     * @param int $provinceId
     * @param int $regencyId
     * @return array
     */
    public function getDistricts($provinceId, $regencyId)
    {
        return Cache::remember('districts_' . $provinceId . '_' . $regencyId, 60 * 24, function () use ($provinceId, $regencyId) {
            $response = Http::withOptions([
                'verify' => false,
            ])->get($this->baseUrl . '/provinces/' . $provinceId . '/regencies/' . $regencyId . '/districts');
            return $response->json();
        });
    }

    /**
     * Mendapatkan daftar desa berdasarkan id provinsi, id kabupaten, dan id kecamatan
     *
     * @param int $provinceId
     * @param int $regencyId
     * @param int $districtId
     * @return array
     */
    public function getVillages($provinceId, $regencyId, $districtId)
    {
        return Cache::remember('villages_' . $provinceId . '_' . $regencyId . '_' . $districtId, 60 * 24, function () use ($provinceId, $regencyId, $districtId) {
            $response = Http::withOptions([
                'verify' => false,
            ])->get($this->baseUrl . '/provinces/' . $provinceId . '/regencies/' . $regencyId . '/districts/' . $districtId . '/villages');
            return $response->json();
        });
    }
}

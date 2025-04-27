<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RegionService;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    protected $regionService;

    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    /**
     * Mendapatkan daftar provinsi
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProvinces()
    {
        $provinces = $this->regionService->getProvinces();
        return response()->json($provinces);
    }

    /**
     * Mendapatkan daftar kabupaten berdasarkan id provinsi
     *
     * @param int $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRegencies($provinceId)
    {
        $regencies = $this->regionService->getRegencies($provinceId);
        return response()->json($regencies);
    }

    /**
     * Mendapatkan daftar kecamatan berdasarkan id provinsi dan id kabupaten
     *
     * @param int $provinceId
     * @param int $regencyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts($provinceId, $regencyId)
    {
        $districts = $this->regionService->getDistricts($provinceId, $regencyId);
        return response()->json($districts);
    }

    /**
     * Mendapatkan daftar desa berdasarkan id provinsi, id kabupaten, dan id kecamatan
     *
     * @param int $provinceId
     * @param int $regencyId
     * @param int $districtId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVillages($provinceId, $regencyId, $districtId)
    {
        $villages = $this->regionService->getVillages($provinceId, $regencyId, $districtId);
        return response()->json($villages);
    }
}

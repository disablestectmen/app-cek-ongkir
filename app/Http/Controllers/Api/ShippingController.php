<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    /**
     * Mencari destinasi berdasarkan keyword
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchDestination(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('limit', 5);

        $result = $this->rajaOngkirService->searchDestination($search, $limit);

        return response()->json($result);
    }

    /**
     * Menghitung ongkos kirim
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculateShipping(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $weight = $request->input('weight');
        $courier = $request->input('courier');

        $params = [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ];

        $result = $this->rajaOngkirService->hitungOngkir($params);

        return response()->json($result);
    }

    /**
     * Mendapatkan agen terdekat berdasarkan koordinat
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNearestAgents(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $result = $this->rajaOngkirService->getNearestAgents($latitude, $longitude);

        return response()->json($result);
    }
}

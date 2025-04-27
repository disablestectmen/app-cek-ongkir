<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Services\RegionService;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $regionService;
    protected $rajaOngkirService;

    public function __construct(RegionService $regionService, RajaOngkirService $rajaOngkirService)
    {
        $this->regionService = $regionService;
        $this->rajaOngkirService = $rajaOngkirService;
    }

    /**
     * Halaman utama aplikasi
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Halaman pencarian agen terdekat
     *
     * @return \Illuminate\View\View
     */
    public function findNearestAgent()
    {
        return view('agent.nearest');
    }

    /**
     * Proses pencarian agen terdekat
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function processNearestAgent(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $agents = $this->rajaOngkirService->getNearestAgents($latitude, $longitude);

        return view('agent.result', compact('agents', 'latitude', 'longitude'));
    }

    /**
     * Halaman cek ongkir
     *
     * @return \Illuminate\View\View
     */
    public function checkShipping()
    {
        return view('shipping.check');
    }

    /**
     * Proses cek ongkir
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function processCheckShipping(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required|numeric|min:1',
            'courier' => 'required',
        ]);

        $params = $request->only(['origin', 'destination', 'weight', 'courier']);
        $result = $this->rajaOngkirService->hitungOngkir($params);

        return view('shipping.result', compact('result', 'params'));
    }
}

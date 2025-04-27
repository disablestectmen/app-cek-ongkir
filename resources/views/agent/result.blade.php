@extends('layouts.app')

@section('title', 'Agen Terdekat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <a href="{{ route('agent.nearest') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">Lokasi Anda</h4>
            </div>
            <div class="card-body">
                <p><strong>Koordinat:</strong> {{ $latitude }}, {{ $longitude }}</p>
                <div id="map" style="height: 300px; width: 100%; border-radius: 10px;"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Agen Terdekat</h4>
            </div>
            <div class="card-body">
                @if(isset($agents['agents']) && count($agents['agents']) > 0)
                    <div class="row">
                        @foreach($agents['agents'] as $agent)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $agent['nama_agen'] }}</h5>
                                        <p class="card-text">{{ $agent['alamat_agen'] }}</p>
                                        <p class="text-primary">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <strong>Jarak:</strong> {{ $agent['jarak'] }}
                                        </p>
                                        <a href="https://www.google.com/maps?q={{ $agent['latitude'] }},{{ $agent['longitude'] }}"
                                           class="btn btn-sm btn-outline-primary"
                                           target="_blank">
                                            <i class="fas fa-directions me-1"></i> Petunjuk Arah
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <p>Ini adalah contoh hasil pencarian agen terdekat. Dalam implementasi nyata, data akan diambil dari database agen.</p>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Agen Jakarta Pusat</h5>
                                        <p class="card-text">Jl. Kebon Sirih No. 10, Jakarta Pusat</p>
                                        <p class="text-primary">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <strong>Jarak:</strong> 2.5 km
                                        </p>
                                        <a href="https://www.google.com/maps?q=-6.1751,106.8272"
                                           class="btn btn-sm btn-outline-primary"
                                           target="_blank">
                                            <i class="fas fa-directions me-1"></i> Petunjuk Arah
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Agen Jakarta Selatan</h5>
                                        <p class="card-text">Jl. Gatot Subroto No. 15, Jakarta Selatan</p>
                                        <p class="text-primary">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <strong>Jarak:</strong> 3.8 km
                                        </p>
                                        <a href="https://www.google.com/maps?q=-6.2349,106.8205"
                                           class="btn btn-sm btn-outline-primary"
                                           target="_blank">
                                            <i class="fas fa-directions me-1"></i> Petunjuk Arah
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi peta
        const map = L.map('map').setView([{{ $latitude }}, {{ $longitude }}], 13);

        // Tambahkan layer tile OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan marker untuk posisi pengguna
        const userMarker = L.marker([{{ $latitude }}, {{ $longitude }}])
            .addTo(map)
            .bindPopup('Lokasi Anda')
            .openPopup();

        // Tambahkan marker untuk agen terdekat
        @if(isset($agents['agents']) && count($agents['agents']) > 0)
            @foreach($agents['agents'] as $agent)
                L.marker([{{ $agent['latitude'] }}, {{ $agent['longitude'] }}])
                    .addTo(map)
                    .bindPopup('{{ $agent['nama_agen'] }}<br>{{ $agent['alamat_agen'] }}<br>Jarak: {{ $agent['jarak'] }}');
            @endforeach
        @else
            // Data contoh untuk demo
            L.marker([-6.1751, 106.8272])
                .addTo(map)
                .bindPopup('Agen Jakarta Pusat<br>Jl. Kebon Sirih No. 10<br>Jarak: 2.5 km');

            L.marker([-6.2349, 106.8205])
                .addTo(map)
                .bindPopup('Agen Jakarta Selatan<br>Jl. Gatot Subroto No. 15<br>Jarak: 3.8 km');
        @endif
    });
</script>
@endpush

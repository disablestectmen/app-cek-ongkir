@extends('layouts.app')

@section('title', 'Cari Agen Terdekat')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Cari Agen Terdekat</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('agent.process') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="useCurrentLocation" class="form-label">Gunakan Lokasi Saat Ini</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="useCurrentLocation">
                            <label class="form-check-label" for="useCurrentLocation">Aktifkan untuk menggunakan lokasi saat ini</label>
                        </div>
                        <div class="form-text">Izinkan browser untuk mengakses lokasi Anda</div>
                    </div>

                    <div id="manualLocationInputs">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Tujuan</label>
                            <select class="form-select @error('alamat') is-invalid @enderror" id="alamat" name="alamat">
                                <option value="" selected disabled>Pilih Alamat Tujuan</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Bandung">Bandung</option>
                                <option value="Surabaya">Surabaya</option>
                                <option value="Medan">Medan</option>
                                <option value="Makassar">Makassar</option>
                            </select>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="coordinateInputs" style="display:none;">
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" readonly>
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" readonly>
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> Koordinat lokasi Anda berhasil diambil
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Cari Agen Terdekat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const useCurrentLocationSwitch = $('#useCurrentLocation');
        const manualLocationInputs = $('#manualLocationInputs');
        const coordinateInputs = $('#coordinateInputs');
        const latitudeInput = $('#latitude');
        const longitudeInput = $('#longitude');

        // Fungsi untuk mendapatkan lokasi
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
                useCurrentLocationSwitch.prop('checked', false);
            }
        }

        // Callback sukses mendapatkan posisi
        function showPosition(position) {
            latitudeInput.val(position.coords.latitude);
            longitudeInput.val(position.coords.longitude);

            manualLocationInputs.hide();
            coordinateInputs.show();
        }

        // Callback error
        function showError(error) {
            let errorMessage = "";

            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = "Pengguna menolak permintaan Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    errorMessage = "Permintaan untuk mendapatkan lokasi pengguna timeout.";
                    break;
                case error.UNKNOWN_ERROR:
                    errorMessage = "Terjadi kesalahan yang tidak diketahui.";
                    break;
            }

            alert(errorMessage);
            useCurrentLocationSwitch.prop('checked', false);
        }

        // Toggle antara lokasi manual dan otomatis
        useCurrentLocationSwitch.change(function() {
            if (this.checked) {
                getLocation();
            } else {
                manualLocationInputs.show();
                coordinateInputs.hide();
                latitudeInput.val('');
                longitudeInput.val('');
            }
        });

        // Untuk alamat yang dipilih dari dropdown, kita hardcode koordinatnya untuk demo
        $('#alamat').change(function() {
            const selectedCity = $(this).val();

            const coordinates = {
                'Jakarta': { lat: -6.2088, lng: 106.8456 },
                'Bandung': { lat: -6.9175, lng: 107.6191 },
                'Surabaya': { lat: -7.2575, lng: 112.7521 },
                'Medan': { lat: 3.5952, lng: 98.6722 },
                'Makassar': { lat: -5.1477, lng: 119.4327 }
            };

            if (selectedCity && coordinates[selectedCity]) {
                latitudeInput.val(coordinates[selectedCity].lat);
                longitudeInput.val(coordinates[selectedCity].lng);
            }
        });
    });
</script>
@endpush

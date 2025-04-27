@extends('layouts.app')

@section('title', 'Cek Ongkir')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Cek Ongkir</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('shipping.process') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="origin" class="form-label">Kota Asal</label>
                        <select class="form-select @error('origin') is-invalid @enderror" id="origin" name="origin" required>
                            <option value="" selected disabled>Pilih Kota Asal</option>
                            <!-- Opsi ini akan diisi dengan JavaScript -->
                        </select>
                        @error('origin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="destination" class="form-label">Kota Tujuan</label>
                        <select class="form-select @error('destination') is-invalid @enderror" id="destination" name="destination" required>
                            <option value="" selected disabled>Pilih Kota Tujuan</option>
                            <!-- Opsi ini akan diisi dengan JavaScript -->
                        </select>
                        @error('destination')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Berat (gram)</label>
                        <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" min="1" value="{{ old('weight', 1000) }}" required>
                        <div class="form-text">Berat barang gunakan titik, contoh: 400 gr = 0.4 kg</div>
                        @error('weight')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="courier" class="form-label">Kurir</label>
                        <select class="form-select @error('courier') is-invalid @enderror" id="courier" name="courier" required>
                            <option value="" selected disabled>Pilih Kurir</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS Indonesia</option>
                            <option value="tiki">TIKI</option>
                        </select>
                        @error('courier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Cek Ongkir</button>
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
        // Fungsi untuk memuat provinsi
        function loadProvinces() {
            $.ajax({
                url: '/api/provinces',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let options = '<option value="" selected disabled>Pilih Provinsi</option>';
                    $.each(data, function(index, province) {
                        options += `<option value="${province.id}">${province.name}</option>`;
                    });
                    $('#province').html(options);
                }
            });
        }

        // Fungsi untuk memuat kota berdasarkan provinsi
        function loadCities(provinceId, targetElement) {
            $.ajax({
                url: `/api/provinces/${provinceId}/regencies`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let options = '<option value="" selected disabled>Pilih Kota/Kabupaten</option>';
                    $.each(data, function(index, city) {
                        options += `<option value="${city.id}">${city.name}</option>`;
                    });
                    $(targetElement).html(options);
                }
            });
        }

        // Load provinsi saat halaman dimuat
        loadProvinces();

        // Event handler untuk perubahan provinsi
        $('#province').change(function() {
            const provinceId = $(this).val();
            if (provinceId) {
                loadCities(provinceId, '#regency');
            }
        });

        // Untuk demo, kita isi dengan beberapa kota populer
        const popularCities = [
            { id: '1', name: 'Jakarta' },
            { id: '2', name: 'Surabaya' },
            { id: '3', name: 'Bandung' },
            { id: '4', name: 'Medan' },
            { id: '5', name: 'Makassar' },
            { id: '6', name: 'Semarang' },
            { id: '7', name: 'Palembang' },
            { id: '8', name: 'Tangerang' },
            { id: '9', name: 'Depok' },
            { id: '10', name: 'Bekasi' }
        ];

        // Isi dropdown kota asal dan tujuan
        let cityOptions = '<option value="" selected disabled>Pilih Kota</option>';
        $.each(popularCities, function(index, city) {
            cityOptions += `<option value="${city.id}">${city.name}</option>`;
        });

        $('#origin').html(cityOptions);
        $('#destination').html(cityOptions);
    });
</script>
@endpush

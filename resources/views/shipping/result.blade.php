@extends('layouts.app')

@section('title', 'Hasil Cek Ongkir')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <a href="{{ route('shipping.check') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">Detail Pengiriman</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Asal:</strong> {{ $params['origin'] }}</p>
                        <p><strong>Tujuan:</strong> {{ $params['destination'] }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Berat:</strong> {{ $params['weight'] }} gram</p>
                        <p><strong>Kurir:</strong> {{ strtoupper($params['courier']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Hasil Cek Ongkir</h4>
            </div>
            <div class="card-body">
                @if(isset($result['rajaongkir']['results']) && !empty($result['rajaongkir']['results']))
                    @foreach($result['rajaongkir']['results'] as $shipping)
                        <div class="mb-4">
                            <h5>{{ strtoupper($shipping['code']) }}</h5>
                            <p class="text-muted">{{ $shipping['name'] }}</p>

                            @if(isset($shipping['costs']) && !empty($shipping['costs']))
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Layanan</th>
                                                <th>Deskripsi</th>
                                                <th>Estimasi</th>
                                                <th>Tarif</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($shipping['costs'] as $cost)
                                                <tr>
                                                    <td><strong>{{ $cost['service'] }}</strong></td>
                                                    <td>{{ $cost['description'] }}</td>
                                                    <td>{{ $cost['cost'][0]['etd'] }} hari</td>
                                                    <td class="text-end">Rp {{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    Tidak ada layanan pengiriman yang tersedia untuk rute ini.
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <p>Ini adalah contoh hasil cek ongkir. Dalam implementasi nyata, data akan diambil dari API RajaOngkir.</p>

                        <div class="mt-3">
                            <h5>JNE</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Layanan</th>
                                            <th>Deskripsi</th>
                                            <th>Estimasi</th>
                                            <th>Tarif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>OKE</strong></td>
                                            <td>Ongkos Kirim Ekonomis</td>
                                            <td>3-4 hari</td>
                                            <td class="text-end">Rp 18.000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>REG</strong></td>
                                            <td>Layanan Reguler</td>
                                            <td>1-2 hari</td>
                                            <td class="text-end">Rp 22.000</td>
                                        </tr>
                                        <tr>
                                            <td><strong>YES</strong></td>
                                            <td>Yakin Esok Sampai</td>
                                            <td>1 hari</td>
                                            <td class="text-end">Rp 30.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="text-center my-5">
            <h1 class="display-4 fw-bold">Selamat Datang di App Cek Ongkir</h1>
            <p class="lead">Solusi mudah untuk mengecek ongkos kirim dan menemukan agen pengiriman terdekat</p>
        </div>

        <div class="row mb-5">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-truck-fast fa-4x mb-3 text-primary"></i>
                        <h3>Cek Ongkir</h3>
                        <p>Hitung ongkos kirim dari berbagai kurir pengiriman dengan cepat dan akurat</p>
                        <a href="{{ route('shipping.check') }}" class="btn btn-primary">Cek Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marker-alt fa-4x mb-3 text-primary"></i>
                        <h3>Agen Terdekat</h3>
                        <p>Temukan agen pengiriman terdekat dari lokasi Anda dengan mudah</p>
                        <a href="{{ route('agent.nearest') }}" class="btn btn-primary">Cari Agen</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h4 class="mb-0">Tentang Aplikasi</h4>
            </div>
            <div class="card-body">
                <p>App Cek Ongkir adalah aplikasi yang memudahkan pengguna untuk:</p>
                <ul>
                    <li>Menyimpan database agen pengiriman di seluruh kota di Indonesia</li>
                    <li>Memberikan rekomendasi agen terdekat dari alamat tujuan</li>
                    <li>Menghitung ongkir berdasarkan parameter seperti berat barang, jarak, dan tarif dinamis</li>
                </ul>
                <p>Aplikasi ini menggunakan data dari API yang telah disediakan untuk memberikan informasi akurat tentang agen pengiriman di seluruh Indonesia.</p>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h4 class="mb-0">Fitur Utama</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0">
                                <i class="fas fa-database fa-2x text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h5>Database Agen</h5>
                                <p>Database lengkap agen pengiriman di seluruh Indonesia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0">
                                <i class="fas fa-location-dot fa-2x text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h5>Rekomendasi Agen</h5>
                                <p>Sistem cerdas untuk merekomendasikan agen terdekat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0">
                                <i class="fas fa-calculator fa-2x text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h5>Kalkulator Ongkir</h5>
                                <p>Hitung ongkir dengan parameter yang akurat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

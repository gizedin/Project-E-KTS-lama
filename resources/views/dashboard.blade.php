@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-3">Dashboard Admin</h3>

    <div class="row">

        <!-- Card 1 -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Akun</h5>
                    <p class="card-text fs-4 fw-bold">123</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Login Hari Ini</h5>
                    <p class="card-text fs-4 fw-bold">57</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Aktif Sekarang</h5>
                    <p class="card-text fs-4 fw-bold">12</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Bagian konten tambahan -->
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title">Informasi Sistem</h5>
            <p class="mb-0">
                Selamat datang di dashboard admin. Anda dapat mengelola akun, melihat data, dan melakukan konfigurasi sistem.
            </p>
        </div>
    </div>

</div>
@endsection

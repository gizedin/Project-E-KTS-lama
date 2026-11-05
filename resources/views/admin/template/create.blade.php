@extends('layouts.app')

@section('title', 'Tambah Template Kartu')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Tambah Template Kartu</h4>

    {{-- INFO SISTEM UKURAN --}}
    <div class="alert alert-info">
        <strong>Sistem Ukuran Template:</strong>
        <ul class="mb-0">
            <li><b>Editor / Web Preview:</b> 110 × 181 mm (≈ 415 × 682 px)</li>
            <li><b>Cetak Kartu:</b> 35 × 58 mm (diskalakan otomatis saat export PDF)</li>
            <li>Template dibuat <b>1 kali</b>, sistem otomatis scaling saat cetak.</li>
        </ul>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.template.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- NAMA TEMPLATE --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Template</label>
                    <input type="text"
                           name="nama_template"
                           class="form-control"
                           placeholder="Contoh: Kartu Siswa 2025"
                           required>
                </div>

                {{-- GAMBAR TEMPLATE --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Gambar Sisi Depan
                            <small class="text-muted">(PNG/JPG · rasio vertikal)</small>
                        </label>
                        <input type="file"
                               name="file_depan"
                               class="form-control"
                               accept="image/png,image/jpeg"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Gambar Sisi Belakang
                            <small class="text-muted">(PNG/JPG · rasio vertikal)</small>
                        </label>
                        <input type="file"
                               name="file_belakang"
                               class="form-control"
                               accept="image/png,image/jpeg"
                               required>
                    </div>
                </div>

                {{-- ORIENTASI --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Orientasi Template</label>
                    <select name="orientasi"
                            class="form-select"
                            required>
                        <option value="vertical" selected>
                            Vertical (Portrait)
                        </option>
                        <option value="horizontal">
                            Horizontal (Landscape)
                        </option>
                    </select>
                    <small class="text-muted">
                        Disarankan <b>Vertical</b> agar sesuai kartu siswa.
                    </small>
                </div>

                {{-- UKURAN (DIKUNCI TAPI TERKIRIM KE REQUEST) --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Ukuran Kartu</label>
                    <input type="hidden"
                           name="ukuran"
                           value="WEB 110x181 mm | CETAK 35x58 mm">
                    <input type="text"
                           class="form-control"
                           value="Web: 110 × 181 mm | Cetak: 35 × 58 mm"
                           readonly>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Status Template</label>
                    <select name="aktif" class="form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

                {{-- ACTION --}}
                <div class="mt-4">
                    <button class="btn btn-success">
                        Simpan Template
                    </button>
                    <a href="{{ route('admin.template.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Tambah Jurusan</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.jurusan.store') }}" method="POST">
                @csrf

                {{-- NAMA JURUSAN --}}
                <div class="mb-3">
                    <label class="form-label">Nama Jurusan</label>
                    <input
                        type="text"
                        name="nama_jurusan"
                        class="form-control @error('nama_jurusan') is-invalid @enderror"
                        placeholder="Contoh: Rekayasa Perangkat Lunak"
                        required
                    >
                    @error('nama_jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KELAS --}}
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input
                        type="text"
                        name="kelas"
                        class="form-control @error('kelas') is-invalid @enderror"
                        placeholder="Contoh: X"
                        required
                    >
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NAMA KELAS (MANUAL & BEBAS) --}}
                <div class="mb-3">
                    <label class="form-label">Nama Kelas</label>
                    <input
                        type="text"
                        name="nama_kelas"
                        class="form-control @error('nama_kelas') is-invalid @enderror"
                        placeholder="Contoh: X RPL 1"
                        required
                    >
                    @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary ms-2">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
@endsection

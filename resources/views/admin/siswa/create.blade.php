@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Tambah Siswa</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.siswa.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" name="nis" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">NISN</label>
                        <input type="text" name="nisn" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                {{-- ✅ FIX --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="id_jurusan" class="form-select" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($jurusans as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Masuk</label>
                    <input type="number" name="tahun_masuk"
                           value="{{ date('Y') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="aktif">Aktif</option>
                        <option value="lulus">Lulus</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>

</div>
@endsection

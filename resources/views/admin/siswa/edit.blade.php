@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Edit Siswa</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" name="nis" value="{{ $siswa->nis }}" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">NISN</label>
                        <input type="text" name="nisn" value="{{ $siswa->nisn }}" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" value="{{ $siswa->nama }}" class="form-control">
                </div>

                {{-- ✅ FIX --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir"
                               value="{{ $siswa->tempat_lahir }}" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                               value="{{ $siswa->tanggal_lahir }}" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ $siswa->alamat }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="id_jurusan" class="form-select">
                        @foreach ($jurusans as $j)
                            <option value="{{ $j->id }}"
                                {{ $siswa->id_jurusan == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Masuk</label>
                    <input type="number" name="tahun_masuk"
                           value="{{ $siswa->tahun_masuk }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="aktif"  {{ $siswa->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="lulus"  {{ $siswa->status == 'lulus' ? 'selected' : '' }}>Lulus</option>
                        <option value="keluar" {{ $siswa->status == 'keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>

</div>
@endsection

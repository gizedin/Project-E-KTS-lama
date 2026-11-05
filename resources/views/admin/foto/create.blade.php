@extends('layouts.app')

@section('title', 'Upload Foto Siswa')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Upload Foto Siswa</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.foto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Pilih Siswa</label>
                    <select name="id_siswa" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($siswas as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Foto</label>
                    <input type="file" name="file_foto" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Foto</label>
                    <select name="aktif" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.foto.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection

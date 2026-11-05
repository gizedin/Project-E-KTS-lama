@extends('layouts.app')

@section('title', 'Edit Foto Siswa')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Edit Foto Siswa</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Pilih Siswa</label>
                    <select name="id_siswa" class="form-control" required>
                        @foreach ($siswas as $s)
                            <option value="{{ $s->id }}" {{ $s->id == $foto->id_siswa ? 'selected' : '' }}>
                                {{ $s->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Saat Ini</label><br>
                    @if($foto->file_path)
                        <img src="{{ asset('storage/' . $foto->file_path) }}" 
                             width="120" class="img-thumbnail mb-2">
                    @else
                        <p class="text-danger">Tidak ada foto.</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Foto (optional)</label>
                    <input type="file" name="file_foto" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Foto</label>
                    <select name="aktif" class="form-control">
                        <option value="1" {{ $foto->aktif ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$foto->aktif ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.foto.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Jurusan')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Edit Jurusan</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" class="form-control"
                           value="{{ $jurusan->nama_jurusan }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control"
                           value="{{ $jurusan->kelas }}" required>
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary ms-2">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection

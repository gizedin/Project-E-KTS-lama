@extends('layouts.app')

@section('title', 'Edit Akun')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-3">Edit Akun</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.akun.update', $akun->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $akun->username }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Password (opsional)</label>
                    <input type="text" name="password" class="form-control" placeholder="Biarkan kosong jika tidak diganti">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ $akun->nama_lengkap }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="id_role" class="form-select" required>
                        <option value="1" {{ $akun->id_role == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $akun->id_role == 2 ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="aktif" class="form-select">
                        <option value="aktif" {{ $akun->aktif == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $akun->aktif == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <button class="btn btn-warning">Update</button>
                <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>

</div>
@endsection

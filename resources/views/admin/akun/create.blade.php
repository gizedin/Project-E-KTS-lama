@extends('layouts.app')

@section('title', 'Tambah Akun')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-3">Tambah Akun</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.akun.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="id_role" class="form-select" required>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>

</div>
@endsection

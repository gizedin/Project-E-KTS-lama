@extends('layouts.app')

@section('title', 'Detail Akun')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-3">Detail Akun</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table">
                <tr>
                    <th>Username</th>
                    <td>{{ $akun->username }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $akun->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $akun->id_role == 1 ? 'Admin' : 'User' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $akun->aktif }}</td>
                </tr>
                <tr>
                    <th>Last Login</th>
                    <td>{{ $akun->last_login ?? '-' }}</td>
                </tr>
            </table>

            <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary">Kembali</a>

        </div>
    </div>

</div>
@endsection

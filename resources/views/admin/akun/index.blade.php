@extends('layouts.app')

@section('title', 'Data Akun')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Data Akun</h4>

    <a href="{{ route('admin.akun.create') }}" class="btn btn-primary mb-3">
        Tambah Akun
    </a>

    {{-- ================= IMPORT EXCEL ================= --}}
    <form action="{{ route('admin.akun.import') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="d-inline">
        @csrf

        <input type="file"
               name="file"
               id="fileImport"
               class="d-none"
               accept=".xlsx,.xls,.csv"
               onchange="this.form.submit()">

        <button type="button"
                class="btn btn-success mb-3"
                onclick="document.getElementById('fileImport').click()">
            Import Excel
        </button>
    </form>

    {{-- ================= FLASH MESSAGE ================= --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- ================= TABLE ================= --}}
    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="40">#</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th width="120">Role</th>
                        <th width="100">Status</th>
                        <th width="170">Last Login</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($akun as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $a->username }}</td>

                            <td>{{ $a->nama_lengkap }}</td>

                            {{-- ROLE (ENUM: admin / user) --}}
                            <td>
                                @if($a->id_role === 'admin')
                                    <span class="badge bg-primary">Admin</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($a->aktif === 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>

                            {{-- LAST LOGIN --}}
                            <td>
                                {{ $a->last_login ? $a->last_login->format('d-m-Y H:i') : '-' }}
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <a href="{{ route('admin.akun.show', $a->id) }}"
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('admin.akun.edit', $a->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.akun.destroy', $a->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Data akun belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection

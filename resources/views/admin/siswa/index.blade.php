@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">Data Siswa</h4>
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary">
            + Tambah Siswa
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableSiswa" class="table table-bordered w-100">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($siswas as $index => $s)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->nisn }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->jenis_kelamin }}</td>

                            <td>{{ $s->jurusan->nama_kelas ?? '-' }}</td>

                            <td>
                                @if($s->status === 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($s->status === 'lulus')
                                    <span class="badge bg-primary">Lulus</span>
                                @else
                                    <span class="badge bg-danger">Keluar</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.siswa.edit', $s->id) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.siswa.destroy', $s->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#tableSiswa').DataTable({
        pageLength: 10,
        responsive: true
    });
});
</script>
@endpush

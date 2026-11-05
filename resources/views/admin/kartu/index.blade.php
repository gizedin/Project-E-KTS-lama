@extends('layouts.app')

@section('title', 'Cetak Kartu ID Siswa')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Cetak Kartu ID Siswa</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <table id="datatable" class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th class="text-center">Foto</th>
                        <th>Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($siswas as $siswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $siswa->nama }}</strong><br>
                            <small class="text-muted">
                                NISN / NIS :
                                {{ $siswa->nisn ?? '-' }} / {{ $siswa->nis ?? '-' }}
                            </small>
                        </td>

                        <td>
                            {{ $siswa->jurusan->nama_kelas ?? '-' }}
                        </td>

                        <td class="text-center">
                            @if($siswa->foto && $siswa->foto->aktif)
                                <img src="{{ asset('storage/'.$siswa->foto->file_path) }}"
                                     width="40"
                                     class="rounded border">
                            @else
                                <span class="badge bg-secondary">Belum Ada</span>
                            @endif
                        </td>

                        <td>
                            @if($siswa->foto && $siswa->foto->aktif)
                                <span class="badge bg-success">Siap Cetak</span>
                            @else
                                <span class="badge bg-danger">Belum Lengkap</span>
                            @endif
                        </td>

                        <td>
                            @if($siswa->foto && $siswa->foto->aktif)
                                <a href="{{ route('admin.kartu.preview', $siswa->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Preview
                                </a>

                                <a href="{{ route('admin.kartu.export', $siswa->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Export PDF
                                </a>
                            @else
                                <span class="text-muted small">
                                    Upload foto dulu
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection

{{-- ❗ SCRIPT TIDAK DIHAPUS --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    new DataTable('#datatable');
});
</script>
@endpush

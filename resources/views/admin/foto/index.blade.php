@extends('layouts.app')

@section('title', 'Data Foto Siswa')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">Data Foto Siswa</h4>
        <a href="{{ route('admin.foto.create') }}" class="btn btn-primary">+ Upload Foto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Nama Siswa</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Tanggal Upload</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($fotos as $f)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $f->siswa->nama }}</td>

                            <td>
                                @if($f->file_path)
                                    <img src="{{ asset('storage/' . $f->file_path) }}" 
                                         width="60" class="img-thumbnail">
                                @else
                                    <span class="text-danger">Tidak ada foto</span>
                                @endif
                            </td>

                            <td>
                                @if($f->aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>

                            <td>{{ \Carbon\Carbon::parse($f->upload_date)->format('d-m-Y') }}</td>

                            <td class="text-nowrap">
                                <a href="{{ route('admin.foto.edit', $f->id) }}" 
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.foto.destroy', $f->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus foto ini?');">
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
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true
        });
    });
</script>
@endpush

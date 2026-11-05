@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">Data Jurusan</h4>
        <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary">+ Tambah Jurusan</a>
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
                        <th>Nama Jurusan</th>
                        <th>Kelas</th>
                        <th>Nama Kelas</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($jurusans as $j)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $j->nama_jurusan }}</td>
                            <td>{{ $j->kelas }}</td>
                            <td>{{ $j->nama_kelas }}</td>

                            <td class="text-nowrap">
                                <a href="{{ route('admin.jurusan.edit', $j->id) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.jurusan.destroy', $j->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus jurusan ini?');">

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
        $('#datatable').DataTable();
    });
</script>
@endpush

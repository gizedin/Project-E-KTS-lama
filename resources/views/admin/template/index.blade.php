@extends('layouts.app')

@section('title', 'Data Template Kartu')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">Data Template Kartu</h4>
        <a href="{{ route('admin.template.create') }}" class="btn btn-primary">
            + Template Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Nama Template</th>
                        <th>Depan</th>
                        <th>Belakang</th>
                        <th>Orientasi</th>
                        <th>Aktif</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($templates as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->nama_template }}</td>

                            <td>
                                @if ($t->file_depan)
                                    <img src="{{ asset('storage/' . $t->file_depan) }}" width="80" class="img-thumbnail">
                                @else
                                    <span class="text-danger">Tidak ada</span>
                                @endif
                            </td>

                            <td>
                                @if ($t->file_belakang)
                                    <img src="{{ asset('storage/' . $t->file_belakang) }}" width="80" class="img-thumbnail">
                                @else
                                    <span class="text-danger">Tidak ada</span>
                                @endif
                            </td>

                            <td>{{ ucfirst($t->orientasi) }}</td>

                            <td>
                                @if ($t->aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak</span>
                                @endif
                            </td>

                            <td class="text-nowrap">
                                <a href="{{ route('admin.template.edit', $t->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.template.destroy', $t->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus template ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
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
            searching: true,
            ordering: true
        });
    });
</script>
@endpush

@extends('layouts.app')

@section('title', 'Pengaturan Field Kartu')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Pengaturan Field Kartu</h4>
        <a href="{{ route('admin.field.create') }}" class="btn btn-primary">
            + Tambah Field
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped" id="datatable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Field</th>
                        <th>Type</th>
                        <th>Sisi</th>
                        <th>Posisi (X,Y)</th>
                        <th>Ukuran (W×H)</th>
                        <th>Font</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($fields as $field)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <span class="fw-semibold">
                                {{ $field->field_key }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-info">
                                {{ strtoupper($field->type) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ strtoupper($field->side) }}
                            </span>
                        </td>

                        <td>
                            X: {{ $field->x }} <br>
                            Y: {{ $field->y }}
                        </td>

                        <td>
                            @if($field->width && $field->height)
                                {{ $field->width }} × {{ $field->height }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            {{ $field->font_size ?? '-' }}px <br>
                            {{ ucfirst($field->font_weight) }}
                        </td>

                        <td>
                            @if($field->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.field.edit', $field->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.field.destroy', $field->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus field ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
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
            ordering: true,
            order: [[0, 'asc']]
        });
    });
</script>
@endpush

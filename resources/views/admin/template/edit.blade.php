@extends('layouts.app')

@section('title', 'Edit Template Kartu')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Edit Template Kartu</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.template.update', $template->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Template</label>
                    <input type="text" name="nama_template" value="{{ $template->nama_template }}" class="form-control" required>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sisi Depan (Ganti opsional)</label>
                        <input type="file" name="file_depan" class="form-control" accept="image/jpeg,image/png">

                        @if ($template->file_depan)
                            <img src="{{ asset('storage/' . $template->file_depan) }}"
                                 width="120" class="img-thumbnail mt-2">
                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sisi Belakang (Ganti opsional)</label>
                        <input type="file" name="file_belakang" class="form-control" accept="image/jpeg,image/png">

                        @if ($template->file_belakang)
                            <img src="{{ asset('storage/' . $template->file_belakang) }}"
                                 width="120" class="img-thumbnail mt-2">
                        @endif
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Orientasi</label>
                    <select name="orientasi" class="form-control" required>
                        <option value="horizontal" {{ $template->orientasi == 'horizontal' ? 'selected' : '' }}>
                            Horizontal
                        </option>
                        <option value="vertical" {{ $template->orientasi == 'vertical' ? 'selected' : '' }}>
                            Vertical
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ukuran Kartu</label>
                    <input type="text" name="ukuran" value="{{ $template->ukuran }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="aktif" class="form-control">
                        <option value="1" {{ $template->aktif ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$template->aktif ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <button class="btn btn-success">Update</button>
                <a href="{{ route('admin.template.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection

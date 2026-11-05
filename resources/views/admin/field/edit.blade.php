@extends('layouts.app')

@section('title', 'Edit Field Kartu')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Edit Field Kartu</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.field.update', $field->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- FIELD KEY --}}
                    <div class="col-md-6">
                        <label class="form-label">Nama Field</label>
                        <input type="text"
                               name="field_key"
                               class="form-control"
                               value="{{ $field->field_key }}"
                               readonly>
                    </div>

                    {{-- TYPE --}}
                    <div class="col-md-6">
                        <label class="form-label">Tipe Field</label>
                        <select name="type" class="form-select">
                            <option value="text" {{ $field->type == 'text' ? 'selected' : '' }}>
                                Text
                            </option>
                            <option value="image" {{ $field->type == 'image' ? 'selected' : '' }}>
                                Image
                            </option>
                        </select>
                    </div>

                    {{-- POSISI --}}
                    <div class="col-md-3">
                        <label class="form-label">Posisi X (px)</label>
                        <input type="number" name="x"
                               class="form-control"
                               value="{{ $field->x }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Posisi Y (px)</label>
                        <input type="number" name="y"
                               class="form-control"
                               value="{{ $field->y }}" required>
                    </div>

                    {{-- SIZE --}}
                    <div class="col-md-3">
                        <label class="form-label">Lebar (px)</label>
                        <input type="number" name="width"
                               class="form-control"
                               value="{{ $field->width }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tinggi (px)</label>
                        <input type="number" name="height"
                               class="form-control"
                               value="{{ $field->height }}">
                    </div>

                    {{-- TEXT STYLE --}}
                    <div class="col-md-3">
                        <label class="form-label">Ukuran Font</label>
                        <input type="number" name="font_size"
                               class="form-control"
                               value="{{ $field->font_size }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Font Weight</label>
                        <select name="font_weight" class="form-select">
                            <option value="normal" {{ $field->font_weight == 'normal' ? 'selected' : '' }}>
                                Normal
                            </option>
                            <option value="bold" {{ $field->font_weight == 'bold' ? 'selected' : '' }}>
                                Bold
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Text Align</label>
                        <select name="text_align" class="form-select">
                            <option value="left" {{ $field->text_align == 'left' ? 'selected' : '' }}>
                                Left
                            </option>
                            <option value="center" {{ $field->text_align == 'center' ? 'selected' : '' }}>
                                Center
                            </option>
                            <option value="right" {{ $field->text_align == 'right' ? 'selected' : '' }}>
                                Right
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Warna Text</label>
                        <input type="color"
                               name="color"
                               class="form-control form-control-color"
                               value="{{ $field->color }}">
                    </div>

                    {{-- SIDE --}}
                    <div class="col-md-6">
                        <label class="form-label">Sisi Kartu</label>
                        <select name="side" class="form-select">
                            <option value="depan" {{ $field->side == 'depan' ? 'selected' : '' }}>
                                Depan
                            </option>
                            <option value="belakang" {{ $field->side == 'belakang' ? 'selected' : '' }}>
                                Belakang
                            </option>
                        </select>
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="aktif" class="form-select">
                            <option value="1" {{ $field->aktif ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="0" {{ !$field->aktif ? 'selected' : '' }}>
                                Nonaktif
                            </option>
                        </select>
                    </div>

                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.field.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

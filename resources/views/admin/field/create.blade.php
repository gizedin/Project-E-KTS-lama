@extends('layouts.app')

@section('title', 'Tambah Field Kartu')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Tambah Field Kartu</h4>

    {{-- INFO ACUAN --}}
    <div class="alert alert-info">
        <strong>Acuan Desain:</strong>
        <ul class="mb-0">
            <li>Editor / Preview: <b>110 × 181 mm</b> (≈ 415 × 682 px)</li>
            <li>Cetak: <b>35 × 58 mm</b> (auto-scale PDF)</li>
            <li>Isi posisi & ukuran field dalam <b>pixel (px)</b></li>
        </ul>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.field.store') }}" method="POST">
                @csrf

                <input type="hidden" id="force_type" name="force_type">

                <div class="row g-3">

                    {{-- FIELD KEY --}}
                    <div class="col-md-6">
                        <label class="form-label">Nama Field</label>
                        <select id="field_key" name="field_key" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="foto">Foto</option>
                            <option value="nama">Nama</option>
                            <option value="nama_jurusan">Nama Jurusan</option>
                            <option value="ttl">Tempat & Tgl Lahir</option>
                            <option value="jenis_kelamin">Jenis Kelamin</option>
                            <option value="alamat">Alamat</option>
                            <option value="nisn_nis">NISN / NIS</option>
                        </select>
                    </div>

                    {{-- TYPE --}}
                    <div class="col-md-6">
                        <label class="form-label">Tipe</label>
                        <select id="type" name="type" class="form-select" required>
                            <option value="text">Text</option>
                            <option value="image">Image</option>
                        </select>
                    </div>

                    {{-- POSISI --}}
                    <div class="col-md-3">
                        <label class="form-label">X (px)</label>
                        <input id="x" name="x" type="number" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Y (px)</label>
                        <input id="y" name="y" type="number" class="form-control" required>
                    </div>

                    {{-- SIZE --}}
                    <div class="col-md-3">
                        <label class="form-label">Lebar (px)</label>
                        <input id="width" name="width" type="number" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tinggi (px)</label>
                        <input id="height" name="height" type="number" class="form-control">
                    </div>

                    {{-- TEXT --}}
                    <div class="col-md-3">
                        <label class="form-label">Font Size</label>
                        <input id="font_size" name="font_size" type="number" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Font Weight</label>
                        <select id="font_weight" name="font_weight" class="form-select">
                            <option value="normal">Normal</option>
                            <option value="bold">Bold</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Align</label>
                        <select id="text_align" name="text_align" class="form-select">
                            <option value="left">Left</option>
                            <option value="center">Center</option>
                            <option value="right">Right</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Warna</label>
                        <input type="color" name="color" value="#000000"
                               class="form-control form-control-color">
                    </div>

                    {{-- SIDE --}}
                    <div class="col-md-6">
                        <label class="form-label">Sisi</label>
                        <select name="side" class="form-select">
                            <option value="depan">Depan</option>
                            <option value="belakang">Belakang</option>
                        </select>
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="aktif" class="form-select">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.field.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- SCRIPT DEFAULT SESUAI BACKGROUND 415x682px --}}
<script>
document.getElementById('field_key').addEventListener('change', function () {
    const field = this.value;

    const type = document.getElementById('type');
    const force = document.getElementById('force_type');

    const x = document.getElementById('x');
    const y = document.getElementById('y');
    const w = document.getElementById('width');
    const h = document.getElementById('height');

    const fs = document.getElementById('font_size');
    const fw = document.getElementById('font_weight');
    const ta = document.getElementById('text_align');

    // Reset
    force.value = '';
    fs.disabled = false;
    fw.value = 'normal';
    ta.value = 'left';

    /* FOTO */
    if (field === 'foto') {
        type.value = 'image';
        force.value = 'image';

        x.value = 40;
        y.value = 110;

        w.value = 110;
        h.value = 140;

        fs.value = '';
        fs.disabled = true;
        ta.value = 'center';
        return;
    }

    /* TEXT DEFAULT */
    type.value = 'text';

    x.value = 170;
    y.value = 115;

    w.value = 220;
    h.value = 24;
    fs.value = 14;

    if (field === 'nama') {
        fs.value = 18;
        fw.value = 'bold';
        h.value = 30;
    }

    if (field === 'nama_jurusan') {
        y.value = 150;        // tepat di bawah nama
        fs.value = 14;
        fw.value = 'normal';
        h.value = 24;
    }

    if (field === 'ttl') {
        y.value = 180;
    }

    if (field === 'jenis_kelamin') {
        y.value = 210;
    }

    if (field === 'alamat') {
        y.value = 240;
        fs.value = 12;
        h.value = 40;
    }

    if (field === 'nisn_nis') {
        y.value = 295;
        fs.value = 16;
        fw.value = 'bold';
        h.value = 28;
    }
});
</script>
@endsection

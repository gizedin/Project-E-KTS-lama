@extends('layouts.app')

@section('title', 'Preview Kartu ID')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Preview Kartu ID - {{ $siswa->nama }}</h4>

    <div class="alert alert-info mb-4">
        <strong>Sistem Ukuran:</strong>
        <ul class="mb-0">
            <li>Preview: <b>415 × 682 px</b></li>
            <li>Cetak: <b>35 × 58 mm</b> (auto-scale PDF)</li>
        </ul>
    </div>

    <div class="d-flex justify-content-center gap-5 flex-wrap">

        {{-- ================= DEPAN ================= --}}
        <div class="text-center">
            <h5 class="fw-bold mb-3">Sisi Depan</h5>

            <div class="card border shadow-sm"
                 style="width:415px;height:682px;position:relative;overflow:hidden;">

                {{-- Background --}}
                <img src="{{ asset('storage/'.$template->file_depan) }}"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">

                @php $currentY = 0; @endphp

                @foreach($fieldsDepan as $field)

                    @php
                        $value = match($field->field_key) {
                            'nama' => $siswa->nama,
                            'nama_jurusan' => optional($siswa->jurusan)->nama_jurusan,
                            'ttl' => trim(
                                ($siswa->tempat_lahir ?? '') . ', ' .
                                optional($siswa->tanggal_lahir)->format('d-m-Y')
                            ),
                            'jenis_kelamin' => $siswa->jenis_kelamin ?? '',
                            'alamat' => $siswa->alamat ?? '',
                            'nisn_nis' => trim(($siswa->nisn ?? '').' / '.($siswa->nis ?? '')),
                            default => null
                        };
                    @endphp

                    {{-- FOTO --}}
                    @if($field->field_key === 'foto')

                        @php
                            $fotoSize = max($field->width, 180);
                            $fotoX = (415 - $fotoSize) / 2;
                            $fotoY = $field->y;
                            $currentY = $fotoY + $fotoSize + 24;
                        @endphp

                        <div style="
                            position:absolute;
                            top:{{ $fotoY }}px;
                            left:{{ $fotoX }}px;
                            width:{{ $fotoSize }}px;
                            height:{{ $fotoSize }}px;
                            border-radius:50%;
                            overflow:hidden;
                            border:4px solid #fff;
                        ">
                            <img src="{{ asset('storage/'.$siswa->foto->file_path) }}"
                                 style="width:100%;height:100%;object-fit:cover;">
                        </div>

                    {{-- TEXT (DIKIRIKAN) --}}
                    @elseif($value !== null)

                        <div style="
                            position:absolute;
                            left:20px;        {{-- ← DIGESER KE KIRI --}}
                            top:{{ $currentY }}px;
                            width:355px;      {{-- ← DISESUAIKAN --}}
                            font-size:{{ $field->font_size }}px;
                            font-weight:{{ $field->font_weight }};
                            color:{{ $field->color }};
                            line-height:1.4;
                            text-align:left;
                        ">
                            {{ $value }}
                        </div>

                        @php $currentY += 32; @endphp

                    @endif

                @endforeach
            </div>
        </div>

        {{-- ================= BELAKANG ================= --}}
        <div class="text-center">
            <h5 class="fw-bold mb-3">Sisi Belakang</h5>

            <div class="card border shadow-sm"
                 style="width:415px;height:682px;position:relative;overflow:hidden;">

                <img src="{{ asset('storage/'.$template->file_belakang) }}"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
            </div>
        </div>

    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('admin.kartu.export', $siswa->id) }}" class="btn btn-primary">
            Export PDF
        </a>
        <a href="{{ route('admin.kartu.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>
@endsection

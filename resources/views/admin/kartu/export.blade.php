<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>
@page {
    size: 35mm 58mm;
    margin: 0;
}

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.card {
    width: 35mm;
    height: 58mm;
    position: relative;
    overflow: hidden;
}

.bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
}

/* TEXT KE KIRI */
.text {
    position: absolute;
    left: 1.5mm;
    right: 2mm;
    line-height: 1.15;
    text-align: left;
}

.foto {
    position: absolute;
    border-radius: 50%;
    overflow: hidden;
    border: 0.5mm solid #fff;
}
</style>
</head>

<body>

{{-- ================= DEPAN ================= --}}
<div class="card">

    <img class="bg" src="{{ public_path('storage/'.$template->file_depan) }}">

    @php
        $currentY = 23.8; // posisi awal aman
    @endphp

    @foreach($fieldsDepan as $field)

        @php
            $value = match($field->field_key) {
                'nama'          => $siswa->nama,
                'nama_jurusan'  => optional($siswa->jurusan)->nama_jurusan,
                'ttl'           => trim(
                                    ($siswa->tempat_lahir ?? '') . ', ' .
                                    optional($siswa->tanggal_lahir)->format('d-m-Y')
                                ),
                'jenis_kelamin' => $siswa->jenis_kelamin ?? '',
                'alamat'        => $siswa->alamat ?? '',
                'nisn_nis'      => trim(($siswa->nisn ?? '').' / '.($siswa->nis ?? '')),
                default         => null
            };
        @endphp

        {{-- FOTO --}}
        @if($field->field_key === 'foto')

            @php
                $fotoSize = 14;
                $fotoX = (35 - $fotoSize) / 2;
                $fotoY = 7;
            @endphp

            <div class="foto"
                 style="
                    top: {{ $fotoY }}mm;
                    left: {{ $fotoX }}mm;
                    width: {{ $fotoSize }}mm;
                    height: {{ $fotoSize }}mm;
                 ">
                <img src="{{ public_path('storage/'.$siswa->foto->file_path) }}"
                     style="width:100%;height:100%;object-fit:cover;">
            </div>

        {{-- TEXT --}}
        @elseif($value !== null)

            @php
                $font = match($field->field_key) {
                    'nama'         => 6.2,
                    'nama_jurusan' => 5.8,
                    'nisn_nis'     => 5.6,
                    default        => 5.2
                };
            @endphp

            <div class="text"
                 style="
                    top: {{ $currentY }}mm;
                    font-size: {{ $font }}pt;
                    font-weight: {{ $field->font_weight }};
                    color: {{ $field->color }};
                 ">
                {{ $value }}
            </div>

            @php
                /*
                  SPACING FINAL:
                  sebelumnya 5.3mm
                  sekarang → 5.8mm (+0.5)
                */
                if ($field->field_key === 'nama_jurusan') {
                    $currentY += 5.8;
                } else {
                    $currentY += 3.1;
                }
            @endphp

        @endif

    @endforeach
</div>

{{-- ================= BELAKANG ================= --}}
<div class="card">
    <img class="bg" src="{{ public_path('storage/'.$template->file_belakang) }}">
</div>

</body>
</html>

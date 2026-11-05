<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Kartu siswa mobile-friendly */
        .siswa-card img {
            width: 100%;
            max-width: 140px;
            height: 180px;
            object-fit: cover;
        }

        @media (max-width: 576px) {
            .siswa-card img {
                max-width: 120px;
                height: 160px;
            }
        }
    </style>
</head>
<body class="bg-light">

{{-- ================= NAVBAR ================= --}}
<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            🎓 Aplikasi Saya
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto align-items-md-center gap-md-2">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home.user') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav>

{{-- ================= CONTENT ================= --}}
<div class="container py-4">

    {{-- ================= WELCOME ================= --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center text-md-start">
            <h4 class="fw-bold mb-1">
                Selamat datang, {{ Auth::user()->nama_lengkap }} 👋
            </h4>
            <p class="text-muted mb-0">
                Login sebagai <strong class="text-capitalize">{{ Auth::user()->id_role }}</strong>
            </p>
        </div>
    </div>

    {{-- ================= FILTER KELAS ================= --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <h6 class="fw-bold mb-3">
                📚 Pilih Kelas
            </h6>

            <form action="{{ route('home.user.filter') }}" method="POST">
                @csrf

                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-7">
                        <label class="form-label">Nama Kelas</label>
                        <select name="nama_kelas" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $k)
                                <option value="{{ $k->nama_kelas }}"
                                    {{ (isset($nama_kelas) && $nama_kelas === $k->nama_kelas) ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-5">
                        <button class="btn btn-primary w-100">
                            🔍 Tampilkan Kartu
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    {{-- ================= HASIL ================= --}}
    @isset($siswas)
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h6 class="fw-bold mb-4 text-center text-md-start">
                🧾 Daftar Kartu — Kelas {{ $nama_kelas }}
            </h6>

            @if($siswas->isEmpty())
                <div class="alert alert-warning text-center">
                    Tidak ada siswa pada kelas ini.
                </div>
            @else
                <div class="row g-3 g-md-4">
                    @foreach($siswas as $siswa)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card siswa-card border shadow-sm h-100">
                                <div class="card-body text-center d-flex flex-column">

                                    <div class="mb-3">
                                        <img src="{{ $siswa->foto
                                            ? asset('storage/'.$siswa->foto->file_path)
                                            : asset('images/default.png') }}"
                                             class="img-thumbnail">
                                    </div>

                                    <h6 class="fw-bold mb-1">
                                        {{ $siswa->nama }}
                                    </h6>

                                    <small class="text-muted mb-3">
                                        {{ $siswa->jurusan->nama_jurusan }}
                                    </small>

                                    <div class="mt-auto">
                                        <a href="{{ route('home.kartu.export', $siswa->id) }}"
                                           class="btn btn-danger btn-sm w-100">
                                            ⬇ Download PDF
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
    @endisset

</div>

</body>
</html>

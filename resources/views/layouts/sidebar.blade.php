<div class="p-3">

    <h5 class="text-primary fw-bold mb-3">Menu</h5>

    <ul class="nav flex-column">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
               href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        {{-- Data Akun --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/akun*') ? 'active' : '' }}"
               href="{{ route('admin.akun.index') }}">
                <i class="bi bi-people me-2"></i> Data Akun
            </a>
        </li>

        {{-- Jurusan --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/jurusan*') ? 'active' : '' }}"
               href="{{ route('admin.jurusan.index') }}">
                <i class="bi bi-grid-3x3-gap me-2"></i> Kelas & Jurusan
            </a>
        </li>

        {{-- Data Siswa --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/siswa*') ? 'active' : '' }}"
               href="{{ route('admin.siswa.index') }}">
                <i class="bi bi-file-earmark-text me-2"></i> Data Siswa
            </a>
        </li>

        {{-- Foto Siswa --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/foto*') ? 'active' : '' }}"
               href="{{ route('admin.foto.index') }}">
                <i class="bi bi-images me-2"></i> Foto Siswa
            </a>
        </li>

        {{-- Template Kartu --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/template*') ? 'active' : '' }}"
               href="{{ route('admin.template.index') }}">
                <i class="bi bi-credit-card me-2"></i> Template Kartu
            </a>
        </li>

        {{-- FIELD / LAYOUT KARTU --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/field*') ? 'active' : '' }}"
               href="{{ route('admin.field.index') }}">
                <i class="bi bi-bounding-box me-2"></i> Layout Field
            </a>
        </li>

        {{-- Kartu --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/kartu*') ? 'active' : '' }}"
               href="{{ route('admin.kartu.index') }}">
                <i class="bi bi-person-vcard me-2"></i> Kartu
            </a>
        </li>

    </ul>
</div>

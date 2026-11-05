<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="#">Aplikasi Saya</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu" aria-controls="navbarMenu"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/profil') }}">
                        <i class="bi bi-person-circle me-1"></i> Profil
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>

    </div>
</nav>

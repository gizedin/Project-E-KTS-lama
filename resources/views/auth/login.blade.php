<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>

    {{-- Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light d-flex align-items-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    {{-- HEADER --}}
                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-1">Login Akun</h4>
                        <p class="text-muted mb-0">
                            Silakan masuk untuk melanjutkan
                        </p>
                    </div>

                    {{-- ERROR LOGIN --}}
                    @if ($errors->any())
                        <div class="alert alert-danger text-center py-2">
                            <small>Username atau password salah</small>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- USERNAME --}}
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">
                                Username
                            </label>

                            <input id="username"
                                   type="text"
                                   class="form-control form-control-lg @error('username') is-invalid @enderror"
                                   name="username"
                                   value="{{ old('username') }}"
                                   placeholder="Masukkan username"
                                   required
                                   autofocus>

                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                Password
                            </label>

                            <input id="password"
                                   type="password"
                                   class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   name="password"
                                   placeholder="Masukkan password"
                                   required>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-grid">
                            <button type="submit"
                                    class="btn btn-primary btn-lg rounded-3">
                                Login
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            {{-- FOOTER --}}
            <p class="text-center text-muted small mt-3 mb-0">
                © {{ date('Y') }} Sistem Manajemen Kartu
            </p>

        </div>
    </div>
</div>

</body>
</html>

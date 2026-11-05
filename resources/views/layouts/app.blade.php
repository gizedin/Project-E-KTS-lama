<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') — {{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:300,400,600,700" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- jQuery wajib sebelum DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- DataTables CSS --}}
    <link rel="stylesheet" 
          href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    {{-- Style tambahan --}}
    <style>
        body {
            background: #f5f7fa;
        }
        .sidebar {
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e1e1e1;
        }
        .sidebar .nav-link {
            color: #333;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 4px;
            transition: 0.2s;
        }
        .sidebar .nav-link:hover {
            background: #e9f3ff;
            color: #0d6efd;
        }
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: white;
        }
    </style>

    @stack('styles')

</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="container-fluid">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-md-2 p-0 sidebar shadow-sm">
                @include('layouts.sidebar')
            </div>

            {{-- Content --}}
            <div class="col-md-10 py-4">
                @yield('content')
            </div>

        </div>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

    @stack('scripts')

</body>
</html>

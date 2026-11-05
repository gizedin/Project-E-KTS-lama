@extends('layouts.app')

@section('title', 'Import Akun Excel')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-3">Import Akun dari Excel</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.akun.import.post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">File Excel</label>
                    <input type="file" name="file" class="form-control" required>
                    <small class="text-muted">Format: XLSX, XLS, CSV</small>
                </div>

                <button class="btn btn-success">Import</button>
                <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AkunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\FieldController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();


// ====================== USER ======================
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'homeUser'])->name('home');
});


// ====================== ADMIN ======================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'homeAdmin'])->name('dashboard');

    Route::prefix('admin')->group(function () {

        // ==================== AKUN ====================
        Route::get('/akun',              [AkunController::class, 'index'])->name('admin.akun.index');
        Route::get('/akun/create',       [AkunController::class, 'create'])->name('admin.akun.create');
        Route::post('/akun',             [AkunController::class, 'store'])->name('admin.akun.store');
        Route::get('/akun/{akun}',       [AkunController::class, 'show'])->name('admin.akun.show');
        Route::get('/akun/{akun}/edit',  [AkunController::class, 'edit'])->name('admin.akun.edit');
        Route::put('/akun/{akun}',       [AkunController::class, 'update'])->name('admin.akun.update');
        Route::delete('/akun/{akun}',    [AkunController::class, 'destroy'])->name('admin.akun.destroy');
        Route::post('/akun/import',      [AkunController::class, 'import'])->name('admin.akun.import');


        // ==================== SISWA ====================
        Route::get('/siswa',                [SiswaController::class, 'index'])->name('admin.siswa.index');
        Route::get('/siswa/create',         [SiswaController::class, 'create'])->name('admin.siswa.create');
        Route::post('/siswa',               [SiswaController::class, 'store'])->name('admin.siswa.store');
        Route::get('/siswa/{siswa}/edit',   [SiswaController::class, 'edit'])->name('admin.siswa.edit');
        Route::put('/siswa/{siswa}',        [SiswaController::class, 'update'])->name('admin.siswa.update');
        Route::delete('/siswa/{siswa}',     [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');


        // ==================== JURUSAN ====================
        Route::get('/jurusan',                 [JurusanController::class, 'index'])->name('admin.jurusan.index');
        Route::get('/jurusan/create',          [JurusanController::class, 'create'])->name('admin.jurusan.create');
        Route::post('/jurusan',                [JurusanController::class, 'store'])->name('admin.jurusan.store');
        Route::get('/jurusan/{jurusan}/edit',  [JurusanController::class, 'edit'])->name('admin.jurusan.edit');
        Route::put('/jurusan/{jurusan}',       [JurusanController::class, 'update'])->name('admin.jurusan.update');
        Route::delete('/jurusan/{jurusan}',    [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');


        // ==================== FOTO ====================
        Route::get('/foto',                [FotoController::class, 'index'])->name('admin.foto.index');
        Route::get('/foto/create',         [FotoController::class, 'create'])->name('admin.foto.create');
        Route::post('/foto',               [FotoController::class, 'store'])->name('admin.foto.store');
        Route::get('/foto/{foto}/edit',    [FotoController::class, 'edit'])->name('admin.foto.edit');
        Route::put('/foto/{foto}',         [FotoController::class, 'update'])->name('admin.foto.update');
        Route::delete('/foto/{foto}',      [FotoController::class, 'destroy'])->name('admin.foto.destroy');


        // ==================== TEMPLATE KARTU ====================
        Route::get('/template',                     [TemplateController::class, 'index'])->name('admin.template.index');
        Route::get('/template/create',              [TemplateController::class, 'create'])->name('admin.template.create');
        Route::post('/template',                    [TemplateController::class, 'store'])->name('admin.template.store');
        Route::get('/template/{template}/edit',     [TemplateController::class, 'edit'])->name('admin.template.edit');
        Route::put('/template/{template}',          [TemplateController::class, 'update'])->name('admin.template.update');
        Route::delete('/template/{template}',       [TemplateController::class, 'destroy'])->name('admin.template.destroy');


        // ==================== FIELD (LAYOUT KARTU) ====================
        Route::get('/field',               [FieldController::class, 'index'])->name('admin.field.index');
        Route::get('/field/create',        [FieldController::class, 'create'])->name('admin.field.create');
        Route::post('/field',              [FieldController::class, 'store'])->name('admin.field.store');
        Route::get('/field/{field}/edit',  [FieldController::class, 'edit'])->name('admin.field.edit');
        Route::put('/field/{field}',       [FieldController::class, 'update'])->name('admin.field.update');
        Route::delete('/field/{field}',    [FieldController::class, 'destroy'])->name('admin.field.destroy');


        // ==================== KARTU (PREVIEW & EXPORT) ====================
        Route::get('/kartu', [KartuController::class, 'index'])
            ->name('admin.kartu.index');

        Route::get('/kartu/{siswa}/preview', [KartuController::class, 'preview'])
            ->name('admin.kartu.preview');

        Route::get('/kartu/{siswa}/export', [KartuController::class, 'exportPdf'])
            ->name('admin.kartu.export');

    });
        
    Route::get('/home', [HomeController::class, 'homeUser'])
        ->name('home.user');

    Route::post('/home/filter', [HomeController::class, 'filterKelas'])
        ->name('home.user.filter');

    Route::get('/home/kartu/{id}/preview', [HomeController::class, 'previewKartu'])
        ->name('home.kartu.preview');

    Route::get('/home/kartu/{id}/pdf', [HomeController::class, 'exportPdf'])
        ->name('home.kartu.export');
});

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();

            $table->string('nis')->unique();
            $table->string('nisn')->unique();
            $table->string('nama');

            // ⬇️ UBAH DI SINI
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);

            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            $table->text('alamat');

            // FK jurusan
            $table->unsignedBigInteger('id_jurusan');
            $table->foreign('id_jurusan')
                ->references('id')
                ->on('jurusans')
                ->onDelete('cascade');

            $table->year('tahun_masuk');

            $table->enum('status', ['aktif', 'lulus', 'keluar'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();

            /**
             * Key data siswa
             * contoh: nama, nis, kelas, jurusan, foto
             */
            $table->string('field_key', 50);

            /**
             * Jenis field
             * text  = tulisan
             * image = foto
             */
            $table->enum('type', ['text', 'image'])->default('text');

            /**
             * Posisi absolut (pixel)
             */
            $table->integer('x');
            $table->integer('y');

            /**
             * Ukuran (wajib untuk image)
             */
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();

            /**
             * Styling text
             */
            $table->integer('font_size')->nullable();
            $table->enum('font_weight', ['normal', 'bold'])->default('normal');
            $table->enum('text_align', ['left', 'center', 'right'])->default('left');
            $table->string('color', 20)->default('#000000');

            /**
             * Sisi kartu
             */
            $table->enum('side', ['depan', 'belakang'])->default('depan');

            /**
             * Status aktif
             */
            $table->boolean('aktif')->default(true);

            $table->timestamps();

            // Index untuk performa
            $table->index(['side', 'aktif']);
            $table->index('field_key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};

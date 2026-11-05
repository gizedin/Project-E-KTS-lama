<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();

            $table->string('nama_template', 100);
            $table->string('file_depan')->nullable();
            $table->string('file_belakang')->nullable();

            // DIISI DARI REQUEST
            $table->string('ukuran', 50);

            $table->enum('orientasi', ['horizontal', 'vertical'])
                  ->default('vertical');

            $table->json('posisi')->nullable();
            $table->boolean('aktif')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};

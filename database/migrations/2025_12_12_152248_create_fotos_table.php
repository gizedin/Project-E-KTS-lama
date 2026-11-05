<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fotos', function (Blueprint $table) {

            $table->id(); // id_foto

            $table->unsignedBigInteger('id_siswa')->unique()->nullable();
            $table->foreign('id_siswa')
                ->references('id')
                ->on('siswas')
                ->onDelete('cascade');

            $table->string('file_path');   
            $table->date('upload_date');   
            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};

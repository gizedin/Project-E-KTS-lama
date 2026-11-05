<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->id(); 
            $table->string('username')->unique();
            $table->string('password_hash'); 
            $table->string('nama_lengkap'); 
            $table->enum('id_role', ['admin', 'user']); 
            $table->enum('aktif', ['aktif', 'nonaktif'])->default('aktif'); 
            $table->timestamp('last_login')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'nisn',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'id_jurusan',
        'tahun_masuk',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_masuk'   => 'integer',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    
    public function foto()
    {
        return $this->hasOne(Foto::class, 'id_siswa');
    }
}

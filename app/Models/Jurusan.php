<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';

    protected $fillable = [
        'nama_jurusan',
        'kelas',
        'nama_kelas',
    ];
    
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_jurusan');
    }
}

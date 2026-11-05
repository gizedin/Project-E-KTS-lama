<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';

    protected $fillable = [
        'id_siswa',
        'file_path',
        'upload_date',
        'aktif',
    ];

    protected $casts = [
        'upload_date' => 'date',
        'aktif'       => 'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}

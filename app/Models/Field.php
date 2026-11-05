<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'fields';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'field_key',     // nama, nis, kelas, jurusan, foto
        'type',          // text | image
        'x',
        'y',
        'width',
        'height',
        'font_size',
        'font_weight',
        'text_align',
        'color',
        'side',          // depan | belakang
        'aktif',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'aktif' => 'boolean',
        'x' => 'integer',
        'y' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'font_size' => 'integer',
    ];

    /**
     * Scope: hanya field aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope: berdasarkan sisi kartu
     */
    public function scopeSide($query, $side)
    {
        return $query->where('side', $side);
    }

    /**
     * Helper: apakah field ini image?
     */
    public function isImage(): bool
    {
        return $this->type === 'image';
    }

    /**
     * Helper: apakah field ini text?
     */
    public function isText(): bool
    {
        return $this->type === 'text';
    }
}

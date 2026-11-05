<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'nama_template',
        'file_depan',
        'file_belakang',
        'ukuran',
        'orientasi',
        'posisi',
        'aktif'
    ];

    protected $casts = [
        'posisi' => 'array',   
        'aktif'  => 'boolean'
    ];

    public function getUkuranPixel($dpi = 300)
    {
        list($w_mm, $h_mm) = explode(' x ', str_replace('mm', '', $this->ukuran));

        $mm_to_inch = 0.0393701;

        return [
            'width'  => round($w_mm * $mm_to_inch * $dpi),
            'height' => round($h_mm * $mm_to_inch * $dpi),
        ];
    }
}

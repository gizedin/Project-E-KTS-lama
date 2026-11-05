<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fields')->truncate();

        DB::table('fields')->insert([

            // ================= DEPAN =================

            [
                'field_key'   => 'foto',
                'type'        => 'image',
                'x'           => 15,
                'y'           => 20,
                'width'       => 85,
                'height'      => 110,
                'side'        => 'depan',
                'aktif'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            [
                'field_key'   => 'nama',
                'type'        => 'text',
                'x'           => 115,
                'y'           => 25,
                'font_size'   => 16,
                'font_weight' => 'bold',
                'text_align'  => 'left',
                'color'       => '#000000',
                'side'        => 'depan',
                'aktif'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            [
                'field_key'   => 'nis',
                'type'        => 'text',
                'x'           => 115,
                'y'           => 50,
                'font_size'   => 12,
                'side'        => 'depan',
                'aktif'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            [
                'field_key'   => 'kelas',
                'type'        => 'text',
                'x'           => 115,
                'y'           => 68,
                'font_size'   => 12,
                'side'        => 'depan',
                'aktif'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            [
                'field_key'   => 'jurusan',
                'type'        => 'text',
                'x'           => 115,
                'y'           => 86,
                'font_size'   => 12,
                'side'        => 'depan',
                'aktif'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // ================= BELAKANG =================

            [
                'field_key'   => 'alamat',
                'type'        => 'text',
                'x'           => 20,
                'y'           => 30,
                'font_size'   => 10,
                'side'        => 'belakang',
                'aktif'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('akun')->insert([
            [
                'username'      => 'admin',
                'password_hash' => Hash::make('admin123'),
                'nama_lengkap'  => 'Administrator',
                'id_role'       => 'admin',
                'aktif'         => 'aktif',
                'last_login'    => null,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],

            [
                'username'      => 'user1',
                'password_hash' => Hash::make('user123'),
                'nama_lengkap'  => 'Pengguna Satu',
                'id_role'       => 'user',
                'aktif'         => 'aktif',
                'last_login'    => null,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],

            [
                'username'      => 'user2',
                'password_hash' => Hash::make('user456'),
                'nama_lengkap'  => 'Pengguna Dua',
                'id_role'       => 'user',
                'aktif'         => 'aktif',
                'last_login'    => null,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ]);
    }
}

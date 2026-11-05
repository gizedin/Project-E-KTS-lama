<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Akun extends Authenticatable
{
    use HasFactory;

    protected $table = 'akun';

    protected $fillable = [
        'username',
        'password_hash',
        'nama_lengkap',
        'id_role',
        'aktif',
        'last_login'
    ];

    protected $hidden = [
        'password_hash'
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    protected $casts = [
        'last_login' => 'datetime',
    ];
}

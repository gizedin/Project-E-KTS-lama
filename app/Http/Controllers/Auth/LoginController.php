<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect setelah login
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if (!$user) {
            return '/login';
        }

        // Jika role = admin
        if ($user->id_role === 'admin') {
            return '/dashboard';
        }

        // Jika role = user
        if ($user->id_role === 'user') {
            return '/home';
        }

        // fallback
        return '/home';
    }

    /**
     * Gunakan username sebagai login
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Proses login custom
     */
    protected function attemptLogin(Request $request)
    {
        $akun = Akun::where('username', $request->username)->first();

        if (!$akun) {
            return false;
        }

        if (!Hash::check($request->password, $akun->password_hash)) {
            return false;
        }

        // login menggunakan ID karena model kompatibel Authenticatable
        Auth::loginUsingId($akun->id);

        // update last login
        $akun->last_login = now();
        $akun->save();

        return true;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}

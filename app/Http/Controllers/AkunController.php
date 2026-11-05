<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use PhpOffice\PhpSpreadsheet\IOFactory;

class AkunController extends Controller
{
    public function __construct()
    {
    $this->middleware(function ($request, $next) {

        if (!Auth::check() || Auth::user()->id_role !== 'admin') {
                abort(403, 'Akses Ditolak');
            }

            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = Akun::all();
        return view('admin.akun.index', compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'      => 'required|unique:akun',
            'password'      => 'required|min:4',
            'nama_lengkap'  => 'required',
            'id_role'       => 'required',
        ]);

        Akun::create([
            'username'      => $request->username,
            'password_hash' => Hash::make($request->password),
            'nama_lengkap'  => $request->nama_lengkap,
            'id_role'       => $request->id_role, // admin / user
            'aktif'         => 'aktif',
            'last_login'    => null
        ]);

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Akun $akun)
    {
        return view('admin.akun.show', compact('akun'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akun $akun)
    {
        return view('admin.akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
    {
        $request->validate([
            'username'     => 'required|unique:akun,username,' . $akun->id,
            'nama_lengkap' => 'required',
            'id_role'      => 'required',
        ]);

        $akun->update([
            'username'     => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'id_role'      => $request->id_role,
            'aktif'        => $request->aktif ?? 'aktif',
        ]);

        if ($request->password) {
            $akun->update([
                'password_hash' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akun $akun)
    {
        $akun->delete();

        return redirect()->route('admin.akun.index')
            ->with('success', 'Akun berhasil dihapus!');
    }

    // ============================================================
    // IMPORT EXCEL
    // ============================================================
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');

        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        for ($i = 1; $i < count($rows); $i++) {

            $username     = $rows[$i][0];
            $password     = $rows[$i][1];
            $nama_lengkap = $rows[$i][2];
            $id_role      = $rows[$i][3];

            if (!$username || !$password) continue;

            Akun::create([
                'username'      => $username,
                'password_hash' => Hash::make($password),
                'nama_lengkap'  => $nama_lengkap,
                'id_role'       => $id_role,
                'aktif'         => 'aktif',
                'last_login'    => null,
            ]);
        }

        return redirect()->route('admin.akun.index')
            ->with('success', 'Import data akun berhasil!');
    }
}

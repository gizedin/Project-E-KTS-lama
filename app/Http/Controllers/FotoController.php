<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
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

    public function index()
    {
        $fotos = Foto::with('siswa')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.foto.index', compact('fotos'));
    }

    public function create()
    {
        $siswas = Siswa::orderBy('nama')->get();

        return view('admin.foto.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa'  => 'required|exists:siswas,id|unique:fotos,id_siswa',
            'file_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'aktif'     => 'required|boolean',
        ]);

        $path = $request->file('file_foto')->store('foto_siswa', 'public');

        Foto::create([
            'id_siswa'    => $request->id_siswa,
            'file_path'   => $path,
            'upload_date' => now(),
            'aktif'       => $request->aktif,
        ]);

        return redirect()->route('admin.foto.index')
            ->with('success', 'Foto berhasil diupload.');
    }

    public function edit(Foto $foto)
    {
        $siswas = Siswa::orderBy('nama')->get();

        return view('admin.foto.edit', compact('foto', 'siswas'));
    }

    public function update(Request $request, Foto $foto)
    {
        $request->validate([
            'id_siswa'  => 'required|exists:siswas,id|unique:fotos,id_siswa,' . $foto->id,
            'file_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'aktif'     => 'required|boolean',
        ]);

        $data = [
            'id_siswa' => $request->id_siswa,
            'aktif'    => $request->aktif,
        ];

        if ($request->hasFile('file_foto')) {

            if ($foto->file_path && Storage::disk('public')->exists($foto->file_path)) {
                Storage::disk('public')->delete($foto->file_path);
            }

            $data['file_path'] = $request->file('file_foto')->store('foto_siswa', 'public');
        }

        $foto->update($data);

        return redirect()->route('admin.foto.index')
            ->with('success', 'Data foto diperbarui.');
    }

    public function destroy(Foto $foto)
    {
        if ($foto->file_path && Storage::disk('public')->exists($foto->file_path)) {
            Storage::disk('public')->delete($foto->file_path);
        }

        $foto->delete();

        return redirect()->route('admin.foto.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}

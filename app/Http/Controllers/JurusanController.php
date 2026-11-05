<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
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
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required',
            'kelas'        => 'required',
            'nama_kelas'   => 'required',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'kelas'        => $request->kelas,
            'nama_kelas'   => $request->nama_kelas,
        ]);

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required',
            'kelas'        => 'required',
            'nama_kelas'   => 'required',
        ]);

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
            'kelas'        => $request->kelas,
            'nama_kelas'   => $request->nama_kelas,
        ]);

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus!');
    }
}

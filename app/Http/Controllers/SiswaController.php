<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SiswaController extends Controller
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
        $siswas = Siswa::with(['jurusan', 'foto'])
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        return view('admin.siswa.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'           => 'required|unique:siswas,nis',
            'nisn'          => 'required|unique:siswas,nisn',
            'nama'          => 'required|string|max:255',

            // ✅ FIXED
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',

            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string',
            'id_jurusan'    => 'required|exists:jurusans,id',
            'tahun_masuk'   => 'required|integer',
            'status'        => 'required|in:aktif,lulus,keluar',
        ]);

        Siswa::create($request->all());

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        return view('admin.siswa.edit', compact('siswa', 'jurusans'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis'           => 'required|unique:siswas,nis,' . $siswa->id,
            'nisn'          => 'required|unique:siswas,nisn,' . $siswa->id,
            'nama'          => 'required|string|max:255',

            // ✅ FIXED
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',

            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string',
            'id_jurusan'    => 'required|exists:jurusans,id',
            'tahun_masuk'   => 'required|integer',
            'status'        => 'required|in:aktif,lulus,keluar',
        ]);

        $siswa->update($request->all());

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}

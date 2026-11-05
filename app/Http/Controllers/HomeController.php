<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Template;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function checkUser()
    {
        if (Auth::user()->id_role !== 'user') {
            abort(403, 'Akses Ditolak');
        }
    }

    public function homeUser()
    {
        $this->checkUser();

        $kelasList = Jurusan::select('nama_kelas')
            ->distinct()
            ->orderBy('nama_kelas')
            ->get();

        return view('home', compact('kelasList'));
    }

    public function filterKelas(Request $request)
    {
        $this->checkUser();

        $request->validate([
            'nama_kelas' => 'required'
        ]);

        $kelasList = Jurusan::select('nama_kelas')
            ->distinct()
            ->orderBy('nama_kelas')
            ->get();

        $siswas = Siswa::with([
                'jurusan',
                'foto' => function ($q) {
                    $q->where('aktif', 1);
                }
            ])
            ->whereHas('jurusan', function ($q) use ($request) {
                $q->where('nama_kelas', $request->nama_kelas);
            })
            ->whereHas('foto', function ($q) {
                $q->where('aktif', 1);
            })
            ->orderBy('nama')
            ->get();

        return view('home', [
            'kelasList'  => $kelasList,
            'siswas'     => $siswas,
            'nama_kelas' => $request->nama_kelas
        ]);
    }

    public function previewKartu($id)
    {
        $this->checkUser();

        $siswa = Siswa::with(['jurusan', 'foto'])->findOrFail($id);

        if (!$siswa->foto || !$siswa->foto->aktif) {
            abort(400, 'Foto tidak tersedia');
        }

        $template = Template::where('aktif', 1)->firstOrFail();

        $fieldsDepan    = Field::aktif()->side('depan')->orderBy('y')->get();
        $fieldsBelakang = Field::aktif()->side('belakang')->orderBy('y')->get();

        return view('user.kartu.preview', compact(
            'siswa',
            'template',
            'fieldsDepan',
            'fieldsBelakang'
        ));
    }

    public function exportPdf($id)
    {
        $this->checkUser();

        $siswa = Siswa::with(['jurusan', 'foto'])->findOrFail($id);

        if (!$siswa->foto || !$siswa->foto->aktif) {
            abort(400, 'Foto tidak tersedia');
        }

        $template = Template::where('aktif', 1)->firstOrFail();

        $fieldsDepan    = Field::aktif()->side('depan')->orderBy('y')->get();
        $fieldsBelakang = Field::aktif()->side('belakang')->orderBy('y')->get();

        $pdf = Pdf::loadView('home.kartu.export', compact(
            'siswa',
            'template',
            'fieldsDepan',
            'fieldsBelakang'
        ))->setPaper([0, 0, 242.65, 153], 'portrait');

        return $pdf->download("Kartu-{$siswa->nama}.pdf");
    }

    public function homeAdmin()
    {
        // Cek role harus 'admin'
        if (Auth::user()->id_role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        return view('dashboard');
    }
}

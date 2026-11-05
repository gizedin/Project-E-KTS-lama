<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Template;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class KartuController extends Controller
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
     * ===============================
     * LIST SISWA (SIAP CETAK KARTU)
     * ===============================
     */
    public function index()
    {
        $siswas = Siswa::with(['jurusan', 'foto'])
            ->orderBy('nama')
            ->get();

        return view('admin.kartu.index', compact('siswas'));
    }

    /**
     * ===============================
     * PREVIEW KARTU (HTML)
     * ===============================
     */
    public function preview($id_siswa)
    {
        $siswa = Siswa::with(['jurusan', 'foto'])->findOrFail($id_siswa);

        if (!$siswa->foto || !$siswa->foto->aktif) {
            abort(400, 'Foto siswa belum tersedia atau tidak aktif');
        }

        $template = Template::where('aktif', 1)->firstOrFail();

        // Field layout dinamis
        $fieldsDepan = Field::aktif()
            ->side('depan')
            ->orderBy('y')
            ->get();

        $fieldsBelakang = Field::aktif()
            ->side('belakang')
            ->orderBy('y')
            ->get();

        return view('admin.kartu.preview', compact(
            'siswa',
            'template',
            'fieldsDepan',
            'fieldsBelakang'
        ));
    }

    /**
     * ===============================
     * EXPORT PDF KARTU
     * ===============================
     */
    public function exportPdf($id_siswa)
    {
        $siswa = Siswa::with(['jurusan', 'foto'])->findOrFail($id_siswa);

        if (!$siswa->foto || !$siswa->foto->aktif) {
            abort(400, 'Foto siswa belum tersedia atau tidak aktif');
        }

        $template = Template::where('aktif', 1)->firstOrFail();

        $fieldsDepan = Field::aktif()
            ->side('depan')
            ->orderBy('y')
            ->get();

        $fieldsBelakang = Field::aktif()
            ->side('belakang')
            ->orderBy('y')
            ->get();

        /**
         * Ukuran kartu PVC CR80
         * 86mm x 54mm = 242.65 x 153 point
         */
        $pdf = Pdf::loadView('admin.kartu.export', compact(
            'siswa',
            'template',
            'fieldsDepan',
            'fieldsBelakang'
        ))->setPaper([0, 0, 242.65, 153], 'portrait');

        return $pdf->download("Kartu-{$siswa->nama}.pdf");
    }
}

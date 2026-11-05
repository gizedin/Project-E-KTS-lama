<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::latest()->get();
        return view('admin.template.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.template.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string|max:100',
            'ukuran'        => 'required|string|max:50',
            'file_depan'    => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'file_belakang' => 'required|image|mimes:jpg,jpeg,png|max:4096',
            'orientasi'     => 'required|in:horizontal,vertical',
            'aktif'         => 'nullable|boolean',
        ]);

        $pathDepan    = $request->file('file_depan')->store('template/depan', 'public');
        $pathBelakang = $request->file('file_belakang')->store('template/belakang', 'public');

        Template::create([
            'nama_template' => $request->nama_template,
            'ukuran'        => $request->ukuran, 
            'file_depan'    => $pathDepan,
            'file_belakang' => $pathBelakang,
            'orientasi'     => $request->orientasi,
            'posisi'        => [],
            'aktif'         => $request->aktif ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.template.index')
            ->with('success', 'Template berhasil dibuat!');
    }

    public function update(Request $request, Template $template)
    {
        $request->validate([
            'nama_template' => 'required|string|max:100',
            'ukuran'        => 'required|string|max:50',
            'file_depan'    => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'file_belakang' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'orientasi'     => 'required|in:horizontal,vertical',
            'aktif'         => 'nullable|boolean',
        ]);

        if ($request->hasFile('file_depan')) {
            Storage::disk('public')->delete($template->file_depan);
            $template->file_depan = $request->file('file_depan')->store('template/depan', 'public');
        }

        if ($request->hasFile('file_belakang')) {
            Storage::disk('public')->delete($template->file_belakang);
            $template->file_belakang = $request->file('file_belakang')->store('template/belakang', 'public');
        }

        $template->nama_template = $request->nama_template;
        $template->ukuran        = $request->ukuran;
        $template->orientasi     = $request->orientasi;
        $template->aktif         = $request->aktif ? 1 : 0;

        $template->save();

        return redirect()
            ->route('admin.template.index')
            ->with('success', 'Template berhasil diperbarui!');
    }

    public function destroy(Template $template)
    {
        Storage::disk('public')->delete($template->file_depan);
        Storage::disk('public')->delete($template->file_belakang);

        $template->delete();

        return redirect()
            ->route('admin.template.index')
            ->with('success', 'Template berhasil dihapus!');
    }
}

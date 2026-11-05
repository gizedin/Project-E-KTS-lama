<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
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
        $fields = Field::orderBy('side')->orderBy('y')->get();
        return view('admin.field.index', compact('fields'));
    }

    public function create()
    {
        return view('admin.field.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_key'   => 'required|string|max:50|unique:fields,field_key',
            'type'        => 'required|in:text,image', 
            'x'           => 'required|integer',
            'y'           => 'required|integer',
            'width'       => 'nullable|integer',
            'height'      => 'nullable|integer',
            'font_size'   => 'nullable|integer',
            'font_weight' => 'required|in:normal,bold',
            'text_align'  => 'required|in:left,center,right',
            'color'       => 'required|string|max:20',
            'side'        => 'required|in:depan,belakang',
            'aktif'       => 'required|boolean',
        ]);

        if ($validated['type'] === 'image') {
            $validated['font_size']   = null;
            $validated['font_weight'] = 'normal';
            $validated['text_align']  = 'center';
            $validated['color']       = '#000000';
        }

        Field::create($validated);

        return redirect()
            ->route('admin.field.index')
            ->with('success', 'Field layout berhasil ditambahkan');
    }

    public function edit(Field $field)
    {
        return view('admin.field.edit', compact('field'));
    }

    public function update(Request $request, Field $field)
    {
        $validated = $request->validate([
            'type'        => 'required|in:text,image',
            'x'           => 'required|integer',
            'y'           => 'required|integer',
            'width'       => 'nullable|integer',
            'height'      => 'nullable|integer',
            'font_size'   => 'nullable|integer',
            'font_weight' => 'required|in:normal,bold',
            'text_align'  => 'required|in:left,center,right',
            'color'       => 'required|string|max:20',
            'side'        => 'required|in:depan,belakang',
            'aktif'       => 'required|boolean',
        ]);

        if ($validated['type'] === 'image') {
            $validated['font_size'] = null;
        }

        $field->update($validated);

        return redirect()
            ->route('admin.field.index')
            ->with('success', 'Field layout berhasil diperbarui');
    }

    public function destroy(Field $field)
    {
        $field->delete();

        return redirect()
            ->route('admin.field.index')
            ->with('success', 'Field layout berhasil dihapus');
    }
}

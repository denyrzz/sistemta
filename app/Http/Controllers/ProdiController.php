<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $data_prodi = Prodi::orderBy('id_prodi')->get();

        return view('admin.prodi', compact('data_prodi'));
    }

    public function create()
    {
        $jurusan = Jurusan::orderBy('id_jurusan')->get();
        return view('admin.form.create_prodi', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,id_jurusan',
            'jenjang' => 'required|string|max:255',
        ]);

        Prodi::create([
            'kode_prodi' => $request->kode_prodi,
            'prodi' => $request->prodi,
            'jurusan_id' => $request->jurusan_id,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('prodi')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $prodi = Prodi::findOrFail($id);

        $jurusan = Jurusan::orderBy('id_jurusan')->get();

        return view('admin.form.edit_prodi', compact('prodi', 'jurusan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,id_jurusan',
            'jenjang' => 'required|string|max:255',
        ]);

        $prodi = Prodi::findOrFail($id);

        $prodi->update([
            'kode_prodi' => $request->kode_prodi,
            'prodi' => $request->prodi,
            'jurusan_id' => $request->jurusan_id,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('prodi')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('prodi')->with('success', 'Prodi berhasil dihapus.');
    }
}

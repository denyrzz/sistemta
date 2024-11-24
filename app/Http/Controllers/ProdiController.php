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

        Prodi::create($request->only(['kode_prodi', 'prodi', 'jurusan_id', 'jenjang']));

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $jurusan = Jurusan::all();
        return view('admin.form.edit_prodi', compact('prodi', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,id_jurusan',
            'jenjang' => 'required|string|max:255',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->only(['kode_prodi', 'prodi', 'jurusan_id', 'jenjang']));

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);

        try {
            $prodi->delete();
            return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('prodi.index')->with('error', 'Prodi gagal dihapus: ' . $e->getMessage());
        }
    }
}

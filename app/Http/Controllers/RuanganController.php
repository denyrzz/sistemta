<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $data_ruangan = Ruangan::all();
        return view('admin.ruangan', compact('data_ruangan'));
    }

    public function create()
    {
        return view('admin.form.create_ruangan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'no_ruangan' => 'required|unique:ruangan,no_ruangan',
        ]);

        Ruangan::create($request->only(['nama_ruangan', 'no_ruangan']));

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit($id_ruangan)
    {
        $ruangan = Ruangan::findOrFail($id_ruangan);
        return view('admin.form.edit_ruangan', compact('ruangan'));
    }

    public function update(Request $request, $id_ruangan)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'no_ruangan' => 'required|unique:ruangan,no_ruangan,' . $id_ruangan,
        ]);

        $ruangan = Ruangan::findOrFail($id_ruangan);
        $ruangan->update($request->only(['nama_ruangan', 'no_ruangan']));

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diupdate.');
    }

    public function destroy($id_ruangan)
    {
        $ruangan = Ruangan::findOrFail($id_ruangan);
        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
